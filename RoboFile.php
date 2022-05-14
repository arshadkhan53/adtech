<?php

/**
 * Base tasks for setting up a module to test within a full Drupal environment.
 *
 * @class RoboFile
 * @codeCoverageIgnore
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Implements constructor
     */
    public function __construct() {
        $this->stopOnFail();
    }

    /**
     * Run coding standard validation.
     *
     * @return void
     */
    public function jobRunCodingStandardCheck() {
        return $this->taskExecStack()
        ->stopOnFail()
        ->exec('vendor/bin/phpcs --config-set installed_path vendor/drupal/coder/coder_sniffer')
        // ->exec('vendor/bin/phpcs --standard=Drupal web/modules/custom')
        // ->exec('vendor/bin/phpcs --standard=DrupalPractice web/modules/custom')
        // This is to just test the script, remove below two lines and uncomment above for custom modules.
        ->exec('vendor/bin/phpcs --standard=Drupal web/core/modules/action/tests/src/Functional/ActionListTest.php')
        ->exec('vendor/bin/phpcs --standard=DrupalPractice web/core/modules/action/tests/src/Functional/ActionListTest.php')
        ->run();
    }

    /**
     * Run test.
     *
     * @return void
     */
    public function jobRunUnitTest() {
        return $this->taskExecStack()
        ->stopOnFail()
        // ->exec('ddev exec -s web vendor/bin/phpunit -c web/core --verbose web/modules/custom')
        // This is to just test the script, remove below line and uncomment above for custom modules.
        ->exec('ddev exec -s web vendor/bin/phpunit -c web/core --verbose web/core/modules/action/tests/src/Unit/Menu/ActionLocalTasksTest.php')
        ->run();
    }

    /**
     * Run test.
     *
     * @return void
     */
    public function jobRunTestChecks() {
        return $this->taskExecStack()
        ->stopOnFail()
        ->exec('vendor/bin/robo job:run-coding-standard-check')
        ->exec('vendor/bin/robo job:run-unit-test')
        ->run();
    }

    /**
     * Run test.
     *
     * @return void
     */
    public function jobRunDeploy() {
        return $this->taskExecStack()
        ->stopOnFail()
        // ->exec('git remote add upstream [YOUR_SERVER_REMOTE_LIKE_PANTHEON_OR_AQUIA]')
        // ->exec('git push upstream')
        ->exec('ddev auth ssh')
        // ->exec('ddev drush @site_alias cim -y')
        // ->exec('ddev drush @site_alias updb -y')
        // ->exec('ddev drush @site_alias cr')
        ->run();
    }
}
