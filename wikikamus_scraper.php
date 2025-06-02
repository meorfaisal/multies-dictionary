<?php
set_time_limit(0);

function scrapWikikamus($url) {
    $html = @file_get_contents($url);
    if ($html === false) {
        echo "Gagal akses: $url\n";
        return [];
    }

    $words = [];
    
    // Cari semua link yang bermula dengan [kata] format wiki link
    // Pattern untuk menangkap wiki links: [word] atau [word](url)
    preg_match_all('/\[\[([^\]|]+)(?:\|[^\]]+)?\]\]|\[([^\]]+)\]\([^)]+\)/u', $html, $wikiMatches);
    
    // Proses wiki links [[word]] format
    if (!empty($wikiMatches[1])) {
        foreach ($wikiMatches[1] as $word) {
            if (!empty(trim($word))) {
                $words[] = trim($word);
            }
        }
    }
    
    // Proses markdown links [word](url) format  
    if (!empty($wikiMatches[2])) {
        foreach ($wikiMatches[2] as $word) {
            if (!empty(trim($word))) {
                $words[] = trim($word);
            }
        }
    }
    
    // Alternatif: cari pattern bullet • diikuti dengan link dalam HTML
    preg_match_all('/• \[([^\]]+)\]/u', $html, $bulletMatches);
    if (!empty($bulletMatches[1])) {
        foreach ($bulletMatches[1] as $word) {
            if (!empty(trim($word))) {
                $words[] = trim($word);
            }
        }
    }
    
    return array_unique($words);
}

$allWords = [];
$baseUrl = "https://ms.wiktionary.org/wiki/Wikikamus:Senarai_perkataan_";

// Scrape beberapa halaman untuk test dahulu
foreach (range('A', 'Z') as $char) {
    $url = $baseUrl . $char;
    echo "Scraping $url ...\n";
    $words = scrapWikikamus($url);
    echo "Berjaya dapat " . count($words) . " perkataan dari halaman $char\n";
    
    $allWords = array_merge($allWords, $words);
    sleep(1); // elak spam server
}

// Buang perkataan duplikat dan susun
$allWords = array_unique($allWords);

// Kemas kini dan tapis perkataan
$cleanedWords = [];
foreach ($allWords as $word) {
    $word = trim($word);
    
    // Skip jika kosong
    if (empty($word)) continue;
    
    // Skip jika hanya nombor
    if (is_numeric($word)) continue;
    
    // Skip jika terlalu pendek (kurang dari 2 karakter)
    if (mb_strlen($word, 'UTF-8') < 2) continue;
    
    // Skip jika mengandungi simbol atau karakter bukan huruf yang tidak sesuai
    if (preg_match('/[<>\[\](){}=+*#@$%^&|\\\\\/]/', $word)) continue;
    
    // Bersihkan tanda baca di hujung
    $word = trim($word, '.,;:!?-_"\'');
    
    // Pecah jika ada koma (multiple words in one entry)
    $parts = preg_split('/\s*,\s*/', $word, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($parts as $part) {
        $part = trim($part, '.,;:!?-_"\'');
        if (!empty($part) && mb_strlen($part, 'UTF-8') >= 2) {
            $cleanedWords[] = $part;
        }
    }
}

// Buang duplikat sekali lagi dan susun
$cleanedWords = array_unique($cleanedWords);
sort($cleanedWords, SORT_STRING | SORT_FLAG_CASE);

// Simpan ke ayat.txt
file_put_contents('ayat.txt', implode(PHP_EOL, $cleanedWords));
echo "Selesai! Jumlah perkataan selepas pembersihan: " . count($cleanedWords) . "\n";

// Hapus bahagian lama yang tidak diperlukan lagi
?>