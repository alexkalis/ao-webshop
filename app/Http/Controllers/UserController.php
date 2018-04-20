<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
class UserController extends Controller
{

  /*
  *when you are want to sign up you get send to the signup page
  *
  */
    public function getSignup() {
      return view('user.signup');
    }
    /*
    *this function signs somebody up
    *The first thing =(validate) checks if the input from the sign-in form is correct and by the e-mail it should be a unique one or else it will give an error
    *The password needs to have minimally 4 tokens and it's the same with the name.
    *$user makes a new user in the User table and it gets the input data from the form in the singup page
    *then it saves the user and if the user is made it logs the user in if not you get an error.
    */
    public function postSignup(Request $request) {
      $this->validate($request, [
        'email' => 'email|required|unique:users',
        'password' => 'required|min:4',
        'name' => 'required|min:4'
      ]);
      $user = new User([
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'name' => $request->input('name')
      ]);
      $user->save();

      Auth::login($user);

      return redirect()->route('user.profile');
    }

    /*
    *when you want to sign in with the sign in button you go to the signin page.
    *in the signinpage this happens:
    *it checks with validate if your credentials match with those of a user that exists in the database.
    *then if the credentials match you will be send to your profile page. it does this with an if and auth and then go's trough your email etc.
    *if it doesn't match you will pe put back to the login page.
    */

    public function getSignin() {
      return view('user.signin');
    }
    public function postSignin(Request $request) {
      $this->validate($request, [
        'email' => 'email|required',
        'password' => 'required|min:4',
        'name' => 'required|min:4'
      ]);
      if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
          return redirect()->route('user.profile');
        } return redirect()->back();
    }
    /*
    *this shows the profile page when you click on the profile link.
    */
    public function getProfile() {
      return view('user.profile');
    }
    /*
    *This logs you out.
    */
    public function getLogout() {
      Auth::logout();
      return redirect()->back();
    }
}
