<?php


class AccountTest extends TestCase
{
    protected $account;

    public function setUp()
    {
        parent::setUp();
        $this->account = new \App\Account();
    }

    public function test_account_has_balance()
    {
        $value = 100;

        $this->assertTrue($this->account->hasBalanceToWithDraw($value));
    }

    public function test_put_balance_in_account()
    {
        $value = 100;
        $this->account->putMoney($value);

        $this->assertEquals($value, $this->account->getBalance());
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function test_insert_negative_value_to_account()
    {
        $value = -100.00;
        $this->account->putMoney($value);
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function test_insert_not_numeric_value_to_account()
    {
        $value = 'abc';
        $this->account->putMoney($value);
    }
}