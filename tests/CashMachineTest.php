<?php


class CashMachineTest extends TestCase
{
    protected $cashMachine;
    protected $account;

    public function setUp()
    {
        parent::setUp();
        $this->account = new \App\Account();
        $this->cashMachine = new \App\CashMachine();
    }

    public function test_make_withdraw_of_10()
    {
        $value = 10;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);
        
        $this->assertEquals([10.00], $withdraw);
    }

    public function test_make_withdraw_of_20()
    {
        $value = 20;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);

        $this->assertEquals([20.00], $withdraw);
    }

    public function test_make_withdraw_of_30()
    {
        $value = 30;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);

        $this->assertEquals([20.00, 10.00], $withdraw);
    }

    public function test_make_withdraw_of_40()
    {
        $value = 40;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);

        $this->assertEquals([20.00, 20.00], $withdraw);
    }

    public function test_make_withdraw_of_50()
    {
        $value = 50;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);

        $this->assertEquals([50.00], $withdraw);
    }

    public function test_make_withdraw_of_80()
    {
        $value = 80;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);

        $this->assertEquals([50.00, 20.00, 10.00], $withdraw);
    }

    public function test_make_withdraw_of_100()
    {
        $value = 100;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);

        $this->assertEquals([100.00], $withdraw);
    }

    public function test_make_withdraw_of_null_value()
    {
        $value = null;
        $withdraw = $this->cashMachine->makeWithdraw($this->account, $value);
        $this->assertEquals([], $withdraw);
    }

    /**
     * @expectedException \App\Exceptions\NoteUnavailableException
     */
    public function test_make_withdraw_of_125()
    {
        $value = 125;
        $this->cashMachine->makeWithdraw($this->account, $value);
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function test_make_withdraw_of_negative_value()
    {
        $value = -125;
        $this->cashMachine->makeWithdraw($this->account, $value);
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function test_make_withdraw_of_invalid_value()
    {
        $value = 'abc';
        $this->cashMachine->makeWithdraw($this->account, $value);
    }

    public function test_put_cash_on_machine()
    {
        $amountOfNotes = 10;
        $valueOfNote = 10;
        $this->cashMachine->putAmountOfCash($valueOfNote, $amountOfNotes);

        $this->assertEquals($amountOfNotes, $this->cashMachine->getAmountOfCash($valueOfNote));
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function test_put_invalid_amount_of_cash_on_machine()
    {
        $amountOfNotes = -10;
        $valueOfNote = 10;
        $this->cashMachine->putAmountOfCash($valueOfNote, $amountOfNotes);
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function test_put_invalid_value_amount_of_cash_on_machine()
    {
        $amountOfNotes = 'abc';
        $valueOfNote = 10;
        $this->cashMachine->putAmountOfCash($valueOfNote, $amountOfNotes);
    }

    /**
     * @expectedException \App\Exceptions\NoteUnavailableException
     */
    public function test_put_invalid_value_of_note_on_machine()
    {
        $amountOfNotes = 10;
        $valueOfNote = 5;
        $this->cashMachine->putAmountOfCash($valueOfNote, $amountOfNotes);
    }
}