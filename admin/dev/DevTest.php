<?php
/**
 * @file
 * PHPUnit tests for Bee command development.
 */

use PHPUnit\Framework\TestCase;
/**
 * Test Bee commands under development.
 */
class DevTest extends TestCase {

  /**
   * Make sure that the db-query command works.
   */
  public function test_db_query_command_works() {
    $output = shell_exec('bee db-query "SELECT type, filename FROM {system} WHERE name = \'system\'"');
    $this->assertStringContainsString("module,core/modules/system/system.module", (string) $output);
  }
}
