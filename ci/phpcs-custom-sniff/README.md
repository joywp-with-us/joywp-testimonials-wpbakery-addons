# Custom PHPCS standard

Custom PHP_CodeSniffer rules (project-agnostic).

## Sniffs

### Custom.Commenting.VersionTagCheck

Ensures that **file**, **class**, **interface**, **trait**, **function**, and **method** docblocks all have a **`@version`** tag.

- **File:** The first token after `<?php` (after whitespace) must be a docblock containing `@version`.
- **Class / Interface / Trait:** Each must have a docblock directly above it with a `@version` tag.
- **Function / Method:** Each must have a docblock directly above it with a `@version` tag.

If a required docblock is missing, or it exists but has no `@version` tag, an error is reported.

**Example – valid:**

```php
<?php
/**
 * Plugin bootstrap.
 *
 * @version 7.0
 */

/**
 * Main controller.
 *
 * @version 7.0
 */
class Vc_Controller {
    /**
     * Do something useful.
     *
     * @param string $id Identifier.
     * @return bool
     * @version 7.0
     */
    public function do_something( $id ) {
        return true;
    }
}
```

**Example – invalid (missing @version):**

```php
/**
 * Do something useful.
 *
 * @param string $id Identifier.
 * @return bool
 */
public function do_something( $id ) {
    return true;
}
```

## Setup

**Option A – Use by path (no config):**

The project ruleset uses `<rule ref="Custom.Commenting.VersionTagCheck"/>`. For that to work, add this standard’s path to PHPCS **once**:

```bash
# From js_composer directory (append if you already have other standards):
./vendor/bin/phpcs --config-set installed_paths $(pwd)/phpcs-custom-sniff

# Or with an absolute path:
./vendor/bin/phpcs --config-set installed_paths /var/docker/Dev/Wordpress/WpbakeryCom/Src/wp-content/plugins/js_composer/phpcs-custom-sniff
```

If you already have other standards in `installed_paths`, append with a comma:

```bash
./vendor/bin/phpcs --config-set installed_paths "/existing/path,$(pwd)/phpcs-custom-sniff"
```

Verify:

```bash
./vendor/bin/phpcs -i
# Should list "Custom" among the installed coding standards.
```

**Alternative – use path in ruleset (no config):**

If you prefer not to set `installed_paths`, use the path in your ruleset instead of the short form:

```xml
<rule ref="phpcs-custom-sniff/Custom/ruleset.xml"/>
```

Then you can run PHPCS with the project ruleset without any prior config.

**Run by path (no config):**

```bash
cd Src/wp-content/plugins/js_composer
./vendor/bin/phpcs --standard=phpcs-custom-sniff/Custom/ruleset.xml -s include/
```

## Use in project

The rule is already included in `project.ruleset.xml`. Run PHPCS as usual, e.g.:

```bash
cd Src/wp-content/plugins/js_composer
phpcs -s --standard=project.ruleset.xml include/autoload/classes/notifications/class-vc-notice-controller.php
```

To only run the version-tag sniff:

```bash
phpcs -s --standard=Custom include/
```

## Customizing the required tag

To require a different tag (e.g. `@since`), set the sniff property in your ruleset:

```xml
<rule ref="Custom.Commenting.VersionTagCheck">
    <properties>
        <property name="requiredTag" value="since"/>
    </properties>
</rule>
```
