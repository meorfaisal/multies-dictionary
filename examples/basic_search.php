<?php
/**
 * Example: Basic Word Search
 * Demonstrates how to use the MULTIES API for word matching
 */

// Example 1: Direct search for exact word
echo "=== Example 1: Search for exact word 'aba' ===\n";
$url1 = "http://localhost/PORTFOLIO/MULTIES/api/index.php?ayat=aba";
echo "URL: $url1\n";
echo "Expected: Exact match for 'aba'\n\n";

// Example 2: Wildcard search
echo "=== Example 2: Wildcard search 'ab?' ===\n";
$url2 = "http://localhost/PORTFOLIO/MULTIES/api/index.php?ayat=ab?";
echo "URL: $url2\n";
echo "Expected: Words like 'aba', 'abi', etc.\n\n";

// Example 3: Prefix search
echo "=== Example 3: Prefix search 'bah*' ===\n";
$url3 = "http://localhost/PORTFOLIO/MULTIES/api/index.php?ayat=bah*";
echo "URL: $url3\n";
echo "Expected: Words starting with 'bah'\n\n";

// Example 4: Using cURL for programmatic access
echo "=== Example 4: PHP cURL Implementation ===\n";
function searchWord($pattern) {
    $url = "http://localhost/PORTFOLIO/MULTIES/api/index.php?ayat=" . urlencode($pattern);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    }
    
    return ['success' => false, 'message' => 'Failed to connect to API'];
}

// Test the function
$result = searchWord('aba');
echo "Search result for 'aba':\n";
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo "\n\n";

echo "=== Usage Instructions ===\n";
echo "1. Start your web server (XAMPP/WAMP)\n";
echo "2. Navigate to: http://localhost/PORTFOLIO/MULTIES/api/index.php?ayat=WORD\n";
echo "3. Replace 'WORD' with your search pattern\n";
echo "4. Use '?' for single character wildcard\n";
echo "5. API returns JSON response with matches\n";
?>
