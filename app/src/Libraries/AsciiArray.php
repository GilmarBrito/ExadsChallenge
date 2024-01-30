<?php

namespace ExadsChallenge\Libraries;

class AsciiArray
{
    private array $asciiArray;
    private array $answer;
    private string $startChar;
    private string $lastChar;

    public function __construct(string $startChar = ',', string $lastChar = '|')
    {
        $this->startChar = $startChar;
        $this->lastChar = $lastChar;
    }
    public function getAnswer(): array
    {
        $this->asciiArray = $this->getRandomAsciiByStartEnd($this->startChar, $this->lastChar);
        $newAsciiArray = $this->removeRandomElement($this->asciiArray);
        $missingCharacter = $this->getMissingCharacter($this->asciiArray, $newAsciiArray);

        $this->answer[] = sprintf('Random array [<info>%s</info>]', implode("", $this->asciiArray));
        $this->answer[] = sprintf('New array    [<info>%s</info>]', implode("", $newAsciiArray));
        $this->answer[] = sprintf('Missing character <info>%s</info>', $missingCharacter);


        return $this->answer;
    }

    protected function getRandomAsciiByStartEnd(string $start = ",", string $finish = "|"): array
    {
        $asciiChars = array_map('chr', range(ord($start), ord($finish)));
        shuffle($asciiChars);

        return $asciiChars;
    }

    protected function removeRandomElement(array $array): array
    {
        unset($array[array_rand($array)]);
        return $array;
    }

    protected function getMissingCharacter(array $originalArray, array $newArray): string
    {
        $charDiff = array_diff($originalArray, $newArray);

        return implode('', $charDiff);
    }
}
