<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Account;
use App\Models\Profile;
use App\Models\InvestmentPlan;
use App\Models\WalletRequest;

use Hash;

class AdminManager extends Controller {
// User CRUD
    public function users(){
        return  $this->respond(User::paginate());
    }

    public function getUser(Request $req, $id){
        return  $this->respond(User::where('id', $id)->first());
    }

    public function updateUser (Request $req, $id) {
      // Validate the request first
      $user = User::find($id);
      if (!$user) return $this->respond(null, 'User does not exist');
      $user->update($req->all());
      return $this->respond('Update Successful');
    }

    public function updateUserProfile (Request $req, $userid) {
      // Validate the request first
      $user = Profile::where('user_id', $userid)->first();
      if (!$user) return $this->respond(null, 'User does not exist');
      $user->update($req->all());
      return $this->respond('Update Successful');
    }

    public function deleteUser (Request $req, $id) {
      try {
        User::findOrFail($id)->delete();
        return $this->respond('User Has been deleted');
      } catch (Exception $e) {
        return $this->respond(null, 'Delete Unsuccessfull');
      }
    }
    # The Add User for the admin must be from the AuthCOntroller So that Email can be sent
    ####################################################################################

// Request CRUD
    public function withdrawalRequests(){
      return $this->respond(WalletRequest::where('type', 'withdraw')->paginate());
    }

    public function otherRequests (Request $req, $type) {
      return $this->respond(WalletRequest::where('type', $type)->paginate());
    }

    public function getRequest (Request $req, $id) {
      return $this->respond(WalletRequest::find($id));
    }

    public function updateRequest (Request $req, $id) {
      if ($request->headers('X-Admin-token') != 'Olivecrest') return $this->respond(null, 'You Dont have permission to do so');
      $request = WalletRequest::where('id' , $id)->first();
      $data = $req->all();
      if (!$request) return $this->respond(null, 'Request Does not exist');
      $request->update($data);

      if ($request->type == 'withdrawal'){
        if (in_array('status', $data) && $data['status'])
            event (new App\Events\Transaction($request, 'add'));
            return $this->respond('Payment Confirmed..');
        }
      }
      return $this->respond('Request Updated Successfully');
    }

    public function deleteRequest (Request $req, $id) {
      try {
        WalletRequest::findOrFail($id)->delete();
        return $this->respond('Request Deleted')
      } catch (Exception $e) {
        return $this->respond(null, 'Request Does not Exist...');
      }
    }
    #######################################################################

// Account CRUD
    public function getAccount(Request $req, $userid){
      return  $this->respond(Account::where('user_id', $userid)->first());
    }

// Plan CRUD
    // The Plans can be retrived fro the info route
    public function addPlan(Request $req) {
      try {
        $plan = InvestmentPlan::create([
          'name' => $req->name,
          'percent_returns' => $req->percentageReturns,
          'btn_link' => '',
          'desc' => $req->description,
          'feat' => $req->feat
        ]);
        return $this->respond($plan);
      } catch (Exception $err) {
        return $this->respond([], 'Something Went Wrong(DB)..');
      }
    }

    public function deletePlan(Request $req, $id) {
      try {
        InvestmentPlan::findOrFail($id)->delete();
        return $this->respond('Plan Deleted');
      } catch (Exception $e) {
        return $this->respond(null, $e);
      }
    }

    public function updatePlan (Request $req, $id) {
      try {
        $data = $req->all();
        InvestmentPlan::findOrFail($id)->update($data);
        return $this->respond('Plan Updated');
      } catch (Exception $e) {
        return $this->respond(null, 'Update Failed...')
      }
    }

// Settings CRUD
    public function set(Request $req) {
      try {
        $settings = $req->all();
        \utils\AppConfig::update($settings);
        return $this->respond('Adjustment Made');
      } catch (Exception $e) {
        return $this->respond(null, 'Failed to make Adjustment');
      }
    }

    public function getSettings() {
      return $this->respond(\utils\AppConfig::get('*'));
    }
