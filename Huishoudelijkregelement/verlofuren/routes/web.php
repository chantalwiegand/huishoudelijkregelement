<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
function getValue($key)
{

    $file = storage_path()  . '/app/storage.json';


    $storage = json_decode(file_get_contents($file), true);
    if (array_key_exists($key, $storage)) {
        return $storage[$key];
    }
    return null;
}
/**
 * Function to persist some data for the example
 * @param string $key
 * @param string $value
 */
function setValue($key, $value)
{
    $file = storage_path()  . '/app/storage.json';
    $storage       = json_decode(file_get_contents($file), true);
    $storage[$key] = $value;
    file_put_contents($file, json_encode($storage));
}
/**
 * Function to authorize with Exact, this redirects to Exact login promt and retrieves authorization code
 * to set up requests for oAuth tokens
 */
function authorize()
{
    $connection = new \Picqer\Financials\Exact\Connection();
    $connection->setRedirectUrl(env('EXACT_ONLINE_REDIRECT_URL'));
    $connection->setExactClientId(env('EXACT_ONLINE_CLIENT_ID'));
    $connection->setExactClientSecret(env('EXACT_ONLINE_CLIENT_SECRET'));
    $connection->redirectForAuthorization();
}
/**
 * Callback function that sets values that expire and are refreshed by Connection.
 *
 * @param \Picqer\Financials\Exact\Connection $connection
 */
function tokenUpdateCallback(\Picqer\Financials\Exact\Connection $connection) {
    // Save the new tokens for next connections
    setValue('accesstoken', $connection->getAccessToken());
    setValue('refreshtoken', $connection->getRefreshToken());
    // Save expires time for next connections
    setValue('expires_in', $connection->getTokenExpires());
}
/**
 * Function to connect to Exact, this creates the client and automatically retrieves oAuth tokens if needed
 *
 * @return \Picqer\Financials\Exact\Connection
 * @throws Exception
 */
function connect()
{
    $connection = new \Picqer\Financials\Exact\Connection();
    $connection->setRedirectUrl(env('EXACT_ONLINE_REDIRECT_URL'));
    $connection->setExactClientId(env('EXACT_ONLINE_CLIENT_ID'));
    $connection->setExactClientSecret(env('EXACT_ONLINE_CLIENT_SECRET'));


    // Retrieves authorizationcode from database
    if (getValue('authorizationcode')) {
        $connection->setAuthorizationCode(getValue('authorizationcode'));
    }
    // Retrieves accesstoken from database
    if (getValue('accesstoken')) {
        $connection->setAccessToken(getValue('accesstoken'));
    }
    // Retrieves refreshtoken from database
    if (getValue('refreshtoken')) {
        $connection->setRefreshToken(getValue('refreshtoken'));
    }
    // Retrieves expires timestamp from database
    if (getValue('expires_in')) {
        $connection->setTokenExpires(getValue('expires_in'));
    }
    // Set callback to save newly generated tokens
    $connection->setTokenUpdateCallback('tokenUpdateCallback');
    // Make the client connect and exchange tokens
    try {
        $connection->connect();
    } catch (\Exception $e) {
        throw new Exception('Could not connect to Exact: ' . $e->getMessage());
    }
    return $connection;
}


Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/exactonline', function(){

    if (isset($_GET['code']) && is_null(getValue('authorizationcode'))) {
        setValue('authorizationcode', $_GET['code']);
        exit;
    }




    /**
     * Function to retrieve persisted data for the example
     * @param string $key
     * @return null|string
     */

// If authorization code is returned from Exact, save this to use for token request
    if (isset($_GET['code']) && is_null(getValue('authorizationcode'))) {
        setValue('authorizationcode', $_GET['code']);
    }
// If we do not have a authorization code, authorize first to setup tokens
    if (getValue('authorizationcode') === null) {
        authorize();
    }
// Create the Exact client
    $connection = connect();
// Get the journals from our administration
    try {
        $journals = new \Picqer\Financials\Exact\Employee($connection);
        $result   = $journals->get();
        foreach ($result as $journal) {
            dump($journal);
//            echo 'Journal: ' . $journal->Description . '<br>';
        }
    } catch (\Exception $e) {
        echo get_class($e) . ' : ' . $e->getMessage();
    }


});


Route::get('mailtest', function(){
    Mail::raw('Dit is een teste-mail', function ($message){
        $message->to('chantalesmee@live.nl');
        $message->subject('Test e-mail');
        $message->from('info@verlof.doitonlinemedia.nl');
    });
});

Route::get('profile', function (){
    //Only authenticated users may enter...
})->middleware('auth');


Route::middleware('auth')->group(function () {

    Route::get('change-password', 'Auth\UpdatePasswordController@index')->name('password.form');
    Route::post('change-password', 'Auth\UpdatePasswordController@update')->name('password.update');

    Route::resource('user', 'UserController');
    Route::resource('leavetype', 'LeaveTypeController');
    Route::resource('role', 'RoleController');
    Route::resource('/', 'HomeController');
    Route::get('displayhours', 'AbsenceController@showAbsence');
    Route::get('absence/all', 'AbsenceController@allRequests');
    Route::resource('absence', 'AbsenceController');
    Route::resource('freeday', 'FreeDayController');
    Route::resource('department', 'DepartmentController');
    Route::get('/set-language/{lang}', 'LanguageController@set')->name('set.language');
});
