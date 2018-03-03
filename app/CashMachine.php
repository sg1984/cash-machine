<?php namespace App;


use App\Exceptions\InsuficentAmoutOfNotesException;
use App\Exceptions\InsuficientBalanceException;
use App\Exceptions\InvalidArgumentException;
use App\Exceptions\NoteUnavailableException;

class CashMachine
{
    protected $amountOfNotes = [
        '100' => null,
        '50'  => null,
        '20'  => null,
        '10'  => null,
    ];

    protected $valuesOfNotes = [
        100, 50, 20, 10
    ];

    public static function makeNewWithDraw(Account $account, $valueToWithdraw)
    {
        $machine = new CashMachine();

        return $machine->makeWithdraw($account, $valueToWithdraw);
    }

    public function makeWithdraw(Account $account, $valueToWithdraw = null)
    {
        if(empty($valueToWithdraw)){
            return [];
        }

        if( $valueToWithdraw < 0 ){
            throw new InvalidArgumentException();
        }

        if( ! is_numeric($valueToWithdraw) ) {
            throw new InvalidArgumentException();
        }

        if( ! $account->hasBalanceToWithDraw($valueToWithdraw) ){
            throw new InsuficientBalanceException();
        }

        $notesToWithdraw = [];
        foreach ($this->valuesOfNotes as $valueOfNote){
            $notesToWithdraw[$valueOfNote] = intval($valueToWithdraw / $valueOfNote);
            $valueToWithdraw = $valueToWithdraw % $valueOfNote;
        }

        if( $valueToWithdraw > 0 ){
            throw new NoteUnavailableException();
        }

        return $this->getAmountOfNotes($notesToWithdraw);
    }

    private function getAmountOfNotes($notesToWithdraw)
    {
        $notes = [];
        foreach ($notesToWithdraw as $valueOfNote => $amountOfNotes ){
            if( $amountOfNotes > 0 ){
                if( $this->hasThisAmountOfNotes($amountOfNotes, $valueOfNote) ){
                    do{
                        $notes[] = number_format($valueOfNote, 2, '.', '');
                        $amountOfNotes--;
                    }while($amountOfNotes > 0);
                }
            }
        }

        return $notes;
    }

    private function hasThisAmountOfNotes($amount, $valueOfNotes)
    {
        if( empty($valueOfNotes) ){
            return false;
        }

        if( empty($valueOfNotes) ){
            return false;
        }

        // This challenge says that the machine has an infinite amount of cash.
        // So I put this ENV workaround.
        if( env('INIFINITE_AMOUNT_NOTES',false) ){
            return true;
        }

        if( $this->getAmountOfCash($valueOfNotes) < $amount ){
            throw new InsuficentAmoutOfNotesException();
        }

        if( $this->amountOfNotes[$valueOfNotes] < $amount ){
            return false;
        }

        return true;
    }

    public function putAmountOfCash($valueOfNotes, $amount)
    {
        if( ! is_numeric($amount) ){
            throw new InvalidArgumentException();
        }

        if( $amount < 0 ){
            throw new InvalidArgumentException();
        }

        if( ! in_array($valueOfNotes, $this->valuesOfNotes) ){
            throw new NoteUnavailableException();
        }

        if( empty($this->amountOfNotes[$valueOfNotes]) ){
            $this->amountOfNotes[$valueOfNotes] = $amount;

            return;
        }

        $this->amountOfNotes[$valueOfNotes] += $amount;

        return;
    }

    public function getAmountOfCash($valueOfNotes = null)
    {
        if( empty($valueOfNotes) ){

            return $this->amountOfNotes;
        }

        return $this->amountOfNotes[$valueOfNotes];
    }
}