<?php
/**
 * Test Suite for MULTIES Word Matcher API
 * Comprehensive testing of the word matching functionality
 */

require_once '../api/index.php';

class MultiesTestSuite {
    private $testCount = 0;
    private $passedTests = 0;
    private $failedTests = 0;
    
    public function runAllTests() {
        echo "=== MULTIES API Test Suite ===\n\n";
        
        $this->testExactMatch();
        $this->testWildcardMatch();
        $this->testEmptySearch();
        $this->testInvalidInput();
        $this->testLongPattern();
        $this->testCaseInsensitive();
        
        $this->showResults();
    }
    
    private function testExactMatch() {
        echo "Test 1: Exact word match\n";
        $_GET['ayat'] = 'aba';
        
        ob_start();
        include '../api/index.php';
        $output = ob_get_clean();
        
        $result = json_decode($output, true);
        
        if ($result['success'] && in_array('aba', $result['data'])) {
            $this->pass("Exact match for 'aba' found");
        } else {
            $this->fail("Exact match for 'aba' not found");
        }
        
        unset($_GET['ayat']);
        echo "\n";
    }
    
    private function testWildcardMatch() {
        echo "Test 2: Wildcard pattern matching\n";
        $_GET['ayat'] = 'ab?';
        
        ob_start();
        include '../api/index.php';
        $output = ob_get_clean();
        
        $result = json_decode($output, true);
        
        if ($result['success'] && count($result['data']) > 0) {
            $this->pass("Wildcard pattern 'ab?' found " . count($result['data']) . " matches");
        } else {
            $this->fail("Wildcard pattern 'ab?' found no matches");
        }
        
        unset($_GET['ayat']);
        echo "\n";
    }
    
    private function testEmptySearch() {
        echo "Test 3: Empty search handling\n";
        
        ob_start();
        include '../api/index.php';
        $output = ob_get_clean();
        
        $result = json_decode($output, true);
        
        if (!$result['success'] && strpos($result['message'], 'diperlukan') !== false) {
            $this->pass("Empty search properly rejected");
        } else {
            $this->fail("Empty search not handled correctly");
        }
        
        echo "\n";
    }
    
    private function testInvalidInput() {
        echo "Test 4: Invalid input handling\n";
        $_GET['ayat'] = '<script>alert("test")</script>';
        
        ob_start();
        include '../api/index.php';
        $output = ob_get_clean();
        
        $result = json_decode($output, true);
        
        if (!$result['success']) {
            $this->pass("Invalid input properly handled");
        } else {
            $this->fail("Invalid input not properly sanitized");
        }
        
        unset($_GET['ayat']);
        echo "\n";
    }
    
    private function testLongPattern() {
        echo "Test 5: Long pattern validation\n";
        $_GET['ayat'] = str_repeat('a', 150); // 150 characters
        
        ob_start();
        include '../api/index.php';
        $output = ob_get_clean();
        
        $result = json_decode($output, true);
        
        if (!$result['success'] && strpos($result['message'], 'terlalu panjang') !== false) {
            $this->pass("Long pattern properly rejected");
        } else {
            $this->fail("Long pattern not handled correctly");
        }
        
        unset($_GET['ayat']);
        echo "\n";
    }
    
    private function testCaseInsensitive() {
        echo "Test 6: Case insensitive search\n";
        $_GET['ayat'] = 'ABA';
        
        ob_start();
        include '../api/index.php';
        $output = ob_get_clean();
        
        $result = json_decode($output, true);
        
        if ($result['success'] && in_array('aba', $result['data'])) {
            $this->pass("Case insensitive search works");
        } else {
            $this->fail("Case insensitive search failed");
        }
        
        unset($_GET['ayat']);
        echo "\n";
    }
    
    private function pass($message) {
        $this->testCount++;
        $this->passedTests++;
        echo "✅ PASS: $message\n";
    }
    
    private function fail($message) {
        $this->testCount++;
        $this->failedTests++;
        echo "❌ FAIL: $message\n";
    }
    
    private function showResults() {
        echo "=== Test Results ===\n";
        echo "Total Tests: {$this->testCount}\n";
        echo "Passed: {$this->passedTests}\n";
        echo "Failed: {$this->failedTests}\n";
        
        if ($this->failedTests === 0) {
            echo "🎉 All tests passed!\n";
        } else {
            echo "⚠️  Some tests failed. Please review.\n";
        }
    }
}

// Run the test suite
$testSuite = new MultiesTestSuite();
$testSuite->runAllTests();
?>
