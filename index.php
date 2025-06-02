<?php
header('Content-Type: application/json');

class WordMatcher {
    private $filename;
    private $words;
    
    public function __construct($filename = "ayat.txt") {
        $this->filename = $filename;
        $this->loadWords();
    }
    
    private function loadWords() {
        if (!file_exists($this->filename)) {
            throw new Exception("File '{$this->filename}' tidak dijumpai.");
        }
        
        $this->words = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if ($this->words === false) {
            throw new Exception("Gagal membaca fail '{$this->filename}'.");
        }
        
        // Remove any empty lines and trim whitespace
        $this->words = array_filter(array_map('trim', $this->words));
    }
    
    public function findMatches($pattern) {
        if (empty($pattern)) {
            return [];
        }
        
        // Sanitize pattern to prevent regex injection
        $pattern = preg_quote($pattern, '/');
        $pattern = str_replace('\?', '.', $pattern);
        
        $matches = [];
        foreach ($this->words as $word) {
            if (preg_match("/^" . $pattern . "$/i", trim($word))) {
                $matches[] = trim($word);
            }
        }
        
        // Remove duplicates and sort
        $matches = array_unique($matches);
        sort($matches);
        
        return $matches;
    }
}

try {
    $response = ['success' => false, 'data' => [], 'message' => ''];
    
    if (!isset($_GET['ayat']) || empty(trim($_GET['ayat']))) {
        $response['message'] = 'Parameter "ayat" diperlukan dan tidak boleh kosong.';
        echo json_encode($response);
        exit;
    }
    
    $searchPattern = trim($_GET['ayat']);
    
    // Validate input length
    if (strlen($searchPattern) > 100) {
        $response['message'] = 'Corak carian terlalu panjang.';
        echo json_encode($response);
        exit;
    }
    
    $matcher = new WordMatcher();
    $matches = $matcher->findMatches($searchPattern);
    
    if (count($matches) > 0) {
        $response['success'] = true;
        $response['data'] = $matches;
        $response['message'] = 'Perkataan yang sepadan dijumpai: ' . count($matches);
    } else {
        $response['message'] = 'Maaf, tiada perkataan yang sepadan dalam carian.';
    }
    
} catch (Exception $e) {
    $response['message'] = 'Ralat: ' . $e->getMessage();
} catch (Error $e) {
    $response['message'] = 'Ralat sistem: ' . $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
