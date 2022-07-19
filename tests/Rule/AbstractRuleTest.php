<?php

declare(strict_types=1);

namespace Yiisoft\Validator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Yiisoft\Validator\ParametrizedRuleInterface;
use Yiisoft\Validator\Tests\Stub\TestRuleHandlerResolverFactory;

abstract class AbstractRuleTest extends TestCase
{
    /**
     * @dataProvider optionsDataProvider
     */
    public function testOptions(ParametrizedRuleInterface $rule, array $expectedOptions): void
    {
        $options = $rule->getOptions();

        $this->assertEquals($expectedOptions, $options);
    }

    public function testGetName(): void
    {
        $rule = $this->getRule();
        $this->assertEquals(lcfirst(substr($rule::class, strrpos($rule::class, '\\') + 1)), $rule->getName());
    }

    public function testHandlerClassName(): void
    {
        $resolver = TestRuleHandlerResolverFactory::create();
        $rule = $this->getRule();
        $this->assertInstanceOf($rule->getHandlerClassName(), $resolver->resolve($rule->getHandlerClassName()));
    }

    abstract protected function optionsDataProvider(): array;

    abstract protected function getRule(): ParametrizedRuleInterface;
}
