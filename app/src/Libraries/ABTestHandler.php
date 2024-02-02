<?php

declare(strict_types=1);

namespace ExadsChallenge\Libraries;

use Exads\ABTestData;
use Exads\ABTestException;
use Exception;

class ABTestHandler
{
    public ABTestData $ABTestProvider;
    protected array $selectedDesign = [];
    protected string $promotionName;
    protected array $promotionDesigns = [];
    protected int $totalSplitPercentile = 0;

    public function __construct(int $promotionId = 3)
    {
        $this->ABTestProvider = new ABTestData($promotionId);

        $this->promotionName = $this->ABTestProvider->getPromotionName();
        $this->promotionDesigns = $this->ABTestProvider->getAllDesigns();
        $this->setTotalSplitPercentile($this->promotionDesigns);
    }

    public function selectDesign(): string
    {
        try {
            $designs = $this->ABTestProvider->getAllDesigns();

            $splitPercentile = $this->totalSplitPercentile;
            $randomInterval = random_int(1, $splitPercentile);

            $currentInterval = 0;

            foreach ($designs as $design) {
                $currentInterval += (int) $design['splitPercent'];
                if ($randomInterval <= $currentInterval) {
                    $this->selectedDesign = $design;

                    return $this->getDesignName($design);
                }
            }
        } catch (ABTestException | Exception $e) {
            return "Error: {$e->getCode()} Message: {$e->getMessage()}";
        }
    }

    public function getPromotionName(): string
    {
        return $this->promotionName;
    }

    protected function setTotalSplitPercentile(array $designs): self
    {
        $isDesignsValid = (empty($designs) === false) &&
            (empty(array_column($designs, 'splitPercent')) === false);

        if ($isDesignsValid === false) {
            throw new Exception('Design data from ABTestProvider is incorrect!');
        }

        $totalPercentile = array_sum(array_column($designs, 'splitPercent'));
        if ($totalPercentile !== 100) {
            throw new Exception('The total splitPercent must be 100.');
        }

        $this->totalSplitPercentile = $totalPercentile;

        return $this;
    }

    protected function getDesignName(array $design): string
    {
        if (array_key_exists('designName', $design) === false) {
            throw new Exception('Design name is invalid!');
        }

        return $design['designName'];
    }
}
