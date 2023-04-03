<?php

namespace Src\Services;

use Exception;

class PluralizeWord
{

    /**
     * Proccess string to plurazie last word
     * @param string $word raw word for plurazile
     * @return string pluralized
     */
    public function pluralize($word): string
    {
        if (!is_string($word))
            throw new Exception('Word require!', 400);

        $word = $this->splitCapitainLetters($word);

        //get a last lettetr
        $last_letter = strtolower($word[strlen($word) - 1]);
        switch ($last_letter) {
            case 'y':
                return substr($word, 0, -1) . 'ies';
            case 's':
                return $word . 'es';
            default:
                return $word . 's';
        }
    }

    /**
     * Process model name to split words
     * @return string  proccessed words
     */
    private function splitCapitainLetters(string $raw): string
    {
        //get last word from namespace
        if (str_contains($raw, '\\')) {
            $rawArr = explode('\\', $raw);
            $raw = $rawArr[count($rawArr) - 1];
        }
        //split capitain letters
        $raw = lcfirst($raw);
        $words = preg_split('/(?=\p{Lu})/u', $raw);

        //(_) between words
        $proccessed = '';
        foreach ($words as $word) {
            if ($proccessed === '')
                $proccessed = $word;
            else
                $proccessed .= '_' . $word;
        }

        return strtolower($proccessed);
    }
}
