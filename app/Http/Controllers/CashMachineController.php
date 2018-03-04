<?php namespace App\Http\Controllers;


use App\Account;
use App\CashMachine;
use Illuminate\Http\Request;

class CashMachineController extends Controller
{
    public function info()
    {
        return file_get_contents(resource_path('views/info.md'));
    }

    public function makeWithdraw(Request $request)
    {
        try {
            $valueToWithdraw = $request->get('value');
            $account = $request->get('account', New Account());
            $withdraw = CashMachine::makeNewWithDraw($account, $valueToWithdraw);

            return $withdraw;
        }
        catch (\Exception $e) {

            return class_basename($e);
        }
    }
}