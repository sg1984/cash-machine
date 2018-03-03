<?php namespace App;


use App\Exceptions\InvalidArgumentException;

class Account
{
    protected $balance = null;

    public function hasBalanceToWithDraw($value)
    {
        // This validation is made just to confirm that the account HAS balance.
        // This challenge says that the account has an infinite amount of cash.
        // So I put this ENV workaround.
        if( env('INIFINITE_ACCOUNT_BALANCE',false) ){
            return true;
        }

        if( $value > $this->getBalance() ){
            return false;
        }

        return true;
    }

    public function putMoney($value)
    {
        if( ! is_numeric($value) ){
            throw new InvalidArgumentException();
        }

        if( $value < 0 ){
            throw new InvalidArgumentException();
        }

        $this->balance += $value;
    }

    public function getBalance(){
        return $this->balance;
    }
}