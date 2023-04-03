<?php

use PHPUnit\Framework\TestCase;
use Src\Services\PluralizeWord;

final class PluralizeWordTest extends TestCase
{
    private PluralizeWord $pluralizeWordService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pluralizeWordService = new PluralizeWord();
    }

    /**
     * @test return list of categories
     */
    public function generate_ploral_from_words()
    {
        $worsResponse = $this->pluralizeWordService->pluralize('Product');

        $this->assertTrue($worsResponse === 'products');
    }

    /**
     * @test return Product with productInformations and ProductStock
     */
    public function exception_into_try_pluralize_array()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('Word require!');

        $this->pluralizeWordService->pluralize(['array for test']);
    }
}
