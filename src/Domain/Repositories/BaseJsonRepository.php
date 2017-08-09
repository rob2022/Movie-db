<?php
namespace App\Domain\Repositories;


abstract class BaseJsonRepository
{
    /**
     * @return string
     */
    abstract protected function getJsonFileName(): string;

    /**
     * @return array
     */
    protected function getJson(): array
    {
        $jsonPath = sprintf('%s./../../../storage/Entities/%s',__DIR__, $this->getJsonFileName());
        $json = file_get_contents($jsonPath);
        $jsonOutput = json_decode($json, true);

        if ($json === false) {
            throw new RuntimeException('Could not resolve ' . $jsonPath);
        }

        if ($jsonOutput === false) {
            throw new RuntimeException('None valid Json ' . $jsonPath);
        }

        return $jsonOutput;
    }
}