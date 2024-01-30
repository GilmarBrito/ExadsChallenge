<?php

namespace ExadsChallenge\Libraries;

class PrimeNumbers
{
    private int $firstNumber;
    private int $lastNumber;
    private array $answer;

    public function __construct(int $firstNumber = 1, int $lastNumber = 100)
    {
        $this->firstNumber = $firstNumber;
        $this->lastNumber = $lastNumber;
    }
    public function getAnswer(): array
    {
        $numbersList = range($this->firstNumber, $this->lastNumber);

        foreach ($numbersList as $number) {
            if ($this->isPrime($number)) {
                $this->answer[] = sprintf('<info>%d [PRIME]</info>', $number);

                continue;
            }
            $multiples = implode(",", $this->getMultiplesOf($number));
            $this->answer[] = sprintf('<info>%d [%s]</info>', $number, $multiples);
        }

        return $this->answer;
    }

    protected function getMultiplesOf(int $number): array
    {
        $multiples = [];
        for ($i = 1; $i <= $number; $i++) {
            if ($number % $i === 0) {
                $multiples[] = $i;
            }
        }
        return $multiples;
    }

    protected function isPrime(int $number): bool
    {
        if ($number <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                break;
            }
        }

        return ($i > sqrt($number)) ? true : false;
    }
}
