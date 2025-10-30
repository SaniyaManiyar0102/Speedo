<?php
use PHPUnit\Framework\TestCase;
require_once 'User.php';
require_once 'db_connect.php';

class UserTest extends TestCase {
    private $user;

    protected function setUp(): void {
        $this->user = new User($conn);
    }

    public function testLoginSuccess() {
        // Assume testuser exists in DB with password "password123"
        $this->assertTrue($this->user->login("testuser", "password123"));
    }

    public function testLoginFailure() {
        $this->assertFalse($this->user->login("testuser", "wrongpass"));
    }

    public function testLoginNonExistentUser() {
        $this->assertFalse($this->user->login("nonuser", "any"));
    }
}
?>
