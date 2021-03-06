<?php
/*
 * SlideAlive - Automatic Presentation Generation Software
 * --------------
 * decode.php - Split a body of text into induvidual search queries.
 * Created by William Teder using PHPstorm on 7/21/14 at 3:11 PM.
 */

class textDecoder {
    public $output = array();

    public function __construct($input) {
        $raw_nouns = file("include/decode/nounlist.txt");
        $nouns = array();
        foreach($raw_nouns as $noun) {
            $nouns[trim($noun)] = true;
        }
        $throwaway_words = array("me", "my", "mine", "hers", "his", "the", "to", "and", "of", "in", "a", "her", "was", "on", "that", "she", "he", "is", "from", "as", "with", "said", "you", "for", "will", "not", "have", "who", "i", "also", "at", "had", "like", "my", "so", "one", "has", "where", "your", "but", "over", "what", "be", "it", "about", "are", "told", "been", "may", "by", "an", "those", "time", "their", "our", "since", "while", "this","if","can","use","does","only","get","using","ensure","all","or","represents","more","than","which","after","they'd","all,");
        $sentences = preg_split('/[.?!\n-]/',$input);;

        foreach($sentences as $sentence) {
            $rough = explode(" ",$sentence);
            if(count($rough) == 1) {
                $rough = array(str_replace(' ','',$rough[0]));
                $sentence = str_replace(' ','',$rough[0]);
            }
            if(count($rough) == 0) {
                $rough = array($sentence);
            }
            $query = "";
            foreach($rough as $word) {
                if(in_array(strtolower(preg_replace( "/\r|\n/", "", $word)),$throwaway_words) == false && isset($nouns[strtolower(trim($word))]) === false) {
                    $query .= " ".strtolower(preg_replace( "/\r|\n/", "", trim($word,',"'."'".';<>')));
                }
            }
            if($query != "" && $query !== " " && $query !== "\n") {
                $this->output[$sentence] = $query;
            }
        }
    }
}
