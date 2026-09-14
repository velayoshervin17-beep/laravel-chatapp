<?php

namespace App\Services;

class ProfanityFilter
{
    protected array $words;

    public function __construct()
    {
        $this->words = file(
            storage_path('app/profanity.txt'),
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
        );
    }

    public function filter(string $text): string
    {
        foreach ($this->words as $word) {
            $word = trim($word);

            $text = preg_replace(
                '/\b' . preg_quote($word, '/') . '\b/i',
                str_repeat('*', strlen($word)),
                $text
            );
        }

        return $text;
    }
}
