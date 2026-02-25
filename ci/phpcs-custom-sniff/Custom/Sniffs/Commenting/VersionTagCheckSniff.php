<?php
/**
 * Ensures that file, class, interface, trait, function and method docblocks have a @since tag.
 *
 * @package Custom
 */

namespace Custom\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class VersionTagCheckSniff implements Sniff {


	/**
	 * Tag name to require (e.g. @since).
	 */
	public string $requiredTag = 'since';

	/**
	 * Registers the tokens that this sniff wants to listen for.
	 *
	 * @return array<int>
	 */
	public function register(): array {
		return [
			T_OPEN_TAG,
			T_CLASS,
			T_INTERFACE,
			T_TRAIT,
			T_FUNCTION,
		];
	}

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the current token in the stack passed in $tokens.
	 */
	public function process( File $phpcsFile, $stackPtr ) {
		$tokens = $phpcsFile->getTokens();
		$code   = $tokens[ $stackPtr ]['code'];

		if ( $code === T_OPEN_TAG ) {
			$this->processFileDocblock( $phpcsFile, $stackPtr );
			return;
		}

		if ( $code === T_CLASS || $code === T_INTERFACE || $code === T_TRAIT ) {
			$this->processClassDocblock( $phpcsFile, $stackPtr, $code );
			return;
		}

		$this->processFunctionDocblock( $phpcsFile, $stackPtr );
	}

	/**
	 * Check file-level docblock for @since.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the open tag.
	 */
	private function processFileDocblock( File $phpcsFile, int $stackPtr ): void {
		$tokens = $phpcsFile->getTokens();

		// Only run once per file (first open tag).
		if ( $stackPtr > 0 ) {
			return;
		}

		$commentStart = $phpcsFile->findNext( T_DOC_COMMENT_OPEN_TAG, $stackPtr + 1 );

		if ( $commentStart === false ) {
			$phpcsFile->addError(
				'File must have a docblock with a @%s tag.',
				$stackPtr,
				'MissingFileDocblock',
				[ $this->requiredTag ]
			);
			return;
		}

		// Ensure this docblock is at the top (only whitespace between open tag and docblock).
		$nextNonEmpty = $phpcsFile->findNext( T_WHITESPACE, $stackPtr + 1, null, true );
		if ( $nextNonEmpty !== $commentStart ) {
			$phpcsFile->addError(
				'File must have a docblock with a @%s tag.',
				$stackPtr,
				'MissingFileDocblock',
				[ $this->requiredTag ]
			);
			return;
		}

		$this->assertDocblockHasVersionTag( $phpcsFile, $commentStart, $stackPtr, 'File', null );
	}

	/**
	 * Check class/interface/trait docblock for @since.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the class/interface/trait token.
	 * @param int                         $tokenCode T_CLASS, T_INTERFACE, or T_TRAIT.
	 */
	private function processClassDocblock( File $phpcsFile, int $stackPtr, int $tokenCode ): void {
		$tokens = $phpcsFile->getTokens();

		$commentStart = $phpcsFile->findPrevious( T_DOC_COMMENT_OPEN_TAG, $stackPtr - 1 );

		if ( $commentStart === false ) {
			$name = $phpcsFile->getDeclarationName( $stackPtr );
			$type = $this->getStructureType( $tokenCode );
			$phpcsFile->addError(
				'%s "%s" must have a docblock with a @%s tag.',
				$stackPtr,
				'MissingDocblock',
				[ $type, $name, $this->requiredTag ]
			);
			return;
		}

		$commentEnd = $tokens[ $commentStart ]['comment_closer'];
		$nextStruct = $phpcsFile->findNext( [ T_CLASS, T_INTERFACE, T_TRAIT ], $commentEnd + 1, $stackPtr + 1 );

		if ( $nextStruct !== $stackPtr ) {
			$name = $phpcsFile->getDeclarationName( $stackPtr );
			$type = $this->getStructureType( $tokenCode );
			$phpcsFile->addError(
				'%s "%s" must have a docblock with a @%s tag.',
				$stackPtr,
				'MissingDocblock',
				[ $type, $name, $this->requiredTag ]
			);
			return;
		}

		$name = $phpcsFile->getDeclarationName( $stackPtr );
		$type = $this->getStructureType( $tokenCode );
		$this->assertDocblockHasVersionTag( $phpcsFile, $commentStart, $stackPtr, $type, $name );
	}

	/**
	 * Check function/method docblock for @since.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the function token.
	 */
	private function processFunctionDocblock( File $phpcsFile, int $stackPtr ): void {
		$tokens = $phpcsFile->getTokens();

		$commentStart = $phpcsFile->findPrevious( T_DOC_COMMENT_OPEN_TAG, $stackPtr - 1 );

		if ( $commentStart === false ) {
			$this->addMissingDocblockError( $phpcsFile, $stackPtr );
			return;
		}

		$commentEnd   = $tokens[ $commentStart ]['comment_closer'];
		$nextFunction = $phpcsFile->findNext( T_FUNCTION, $commentEnd + 1, $stackPtr + 1 );
		if ( $nextFunction !== $stackPtr ) {
			$this->addMissingDocblockError( $phpcsFile, $stackPtr );
			return;
		}

		$name = $phpcsFile->getDeclarationName( $stackPtr );
		$type = $this->getFunctionType( $phpcsFile, $stackPtr );
		$this->assertDocblockHasVersionTag( $phpcsFile, $commentStart, $stackPtr, $type, $name );
	}

	/**
	 * Check that the docblock at commentStart contains the required @since tag.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile     The file being scanned.
	 * @param int                         $commentStart Position of the docblock open tag.
	 * @param int                         $stackPtr     Position of the associated token (for context).
	 * @param string                      $type         "File", "Class", "Interface", "Trait", "Function", "Method".
	 * @param string|null                 $name         Name of the element, or null for file.
	 */
	private function assertDocblockHasVersionTag( File $phpcsFile, int $commentStart, int $stackPtr, string $type, ?string $name ): void {
		$tokens = $phpcsFile->getTokens();

		if ( ! isset( $tokens[ $commentStart ]['comment_tags'] ) ) {
			$this->addMissingVersionError( $phpcsFile, $commentStart, $type, $name );
			return;
		}

		$hasVersion = false;
		foreach ( $tokens[ $commentStart ]['comment_tags'] as $tagPtr ) {
			$tagContent = $tokens[ $tagPtr ]['content'];
			if ( strtolower( $tagContent ) === '@' . strtolower( $this->requiredTag ) ) {
				$hasVersion = true;
				break;
			}
		}

		if ( ! $hasVersion ) {
			$this->addMissingVersionError( $phpcsFile, $commentStart, $type, $name );
		}
	}

	/**
	 * Add error when there is no docblock before the function/method.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the function token.
	 */
	private function addMissingDocblockError( File $phpcsFile, int $stackPtr ): void {
		$name = $phpcsFile->getDeclarationName( $stackPtr );
		$type = $this->getFunctionType( $phpcsFile, $stackPtr );
		$data = [ $type, $name, $this->requiredTag ];
		$phpcsFile->addError( '%s "%s" must have a docblock with a @%s tag.', $stackPtr, 'MissingDocblock', $data );
	}

	/**
	 * Add error when docblock exists but @since tag is missing.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile     The file being scanned.
	 * @param int                         $commentStart The position of the docblock open tag.
	 * @param string                      $type         "File", "Class", "Method", etc.
	 * @param string|null                 $name         Name of the element, or null for file.
	 */
	private function addMissingVersionError( File $phpcsFile, int $commentStart, string $type, ?string $name ): void {
		if ( $name !== null ) {
			$message = '%s "%s" must have a @%s tag in its docblock.';
			$data    = [ $type, $name, $this->requiredTag ];
		} else {
			$message = '%s must have a @%s tag in its docblock.';
			$data    = [ $type, $this->requiredTag ];
		}
		$phpcsFile->addError( $message, $commentStart, 'MissingVersionTag', $data );
	}

	/**
	 * Returns "Class", "Interface", or "Trait" for the given token code.
	 *
	 * @param int $tokenCode T_CLASS, T_INTERFACE, or T_TRAIT.
	 */
	private function getStructureType( int $tokenCode ): string {
		if ( $tokenCode === T_INTERFACE ) {
			return 'Interface';
		}
		if ( $tokenCode === T_TRAIT ) {
			return 'Trait';
		}
		return 'Class';
	}

	/**
	 * Returns "Method" or "Function" depending on context.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the function token.
	 */
	private function getFunctionType( File $phpcsFile, int $stackPtr ): string {
		$tokens   = $phpcsFile->getTokens();
		$classPtr = $phpcsFile->findPrevious( T_CLASS, $stackPtr - 1 );
		if ( $classPtr !== false && isset( $tokens[ $classPtr ]['scope_closer'] ) && $tokens[ $classPtr ]['scope_closer'] > $stackPtr ) {
			return 'Method';
		}
		$traitPtr = $phpcsFile->findPrevious( T_TRAIT, $stackPtr - 1 );
		if ( $traitPtr !== false && isset( $tokens[ $traitPtr ]['scope_closer'] ) && $tokens[ $traitPtr ]['scope_closer'] > $stackPtr ) {
			return 'Method';
		}
		$interfacePtr = $phpcsFile->findPrevious( T_INTERFACE, $stackPtr - 1 );
		if ( $interfacePtr !== false && isset( $tokens[ $interfacePtr ]['scope_closer'] ) && $tokens[ $interfacePtr ]['scope_closer'] > $stackPtr ) {
			return 'Method';
		}
		return 'Function';
	}
}
