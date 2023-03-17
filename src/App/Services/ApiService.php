<?php
namespace App\Services;

//require ('../../../vendor/autoload.php'); 

use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\GuzzleException;
use \GuzzleHttp\RequestOptions;
use LoginType;
use RefreshTokenType;
use ScheduleMeetingType;

class ApiService {
    private const BASE_URL = 'https://api.meethour.io';
    private const API_VERSION = 'v1.1';
    private const GRANT_TYPE = 'password';

    private $httpClient;
    private static $accessToken;

    public function __construct() {
        $this->httpClient = new Client([
            'base_uri' => self::BASE_URL
        ]);
    }

    private static function apiEndpointUrl(string $endpoint): string {
        switch ($endpoint) {
            case 'login':
                return self::BASE_URL . '/oauth/token';
            case 'add_contact':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/customer/addcontact';
            case 'contacts_list':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/customer/contacts';
            case 'schedule_meeting':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/schedulemeeting';
            case 'get_jwt':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/getjwt';
            case 'upcoming_meeting':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/upcomingmeetings';
            case 'timezone':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/getTimezone';
            case 'recordings_list':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/customer/videorecordinglist';
            case 'edit_meeting':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/editmeeting';
            case 'edit_contact':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/customer/editcontact';
            case 'view_meeting':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/viewmeeting';
            case 'archive_meeting':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/archivemeeting';
            case 'missed_meetings':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/missedmeetings';
            case 'completed_meetings':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/meeting/completedmeeting';
            case 'user_details':
                return self::BASE_URL . '/api/' . self::API_VERSION . '/customer/user_details';
            case 'refresh_token':
                return self::BASE_URL . '/oauth/token';
            default:
                throw new \Exception('Invalid endpoint');
        }
    }

    private static function substitutePathParameter(string $url, array $pathParam = []): string {
        foreach ($pathParam as $item) {
            $url = str_replace('{' . $item['key'] . '}', $item['value'] ?? '', $url);
        }

        return $url;
    }

    private static function getHeaders(string $token): array {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
    }

    /**
     * postFetch() : For making Post HTTP Methods via Guzzle HTTP Client
     * @param {string} endpoint End Point types.
     * @param {any} body API call body.
     * @param {PathParam} pathParam additional parameters to be passed to API
     * @returns {string} response data that we get from API
    **/
         private static function postFetch(string $token, string $endpoint, $body, array $pathParam = []) {
        $constructedUrl = self::substitutePathParameter(
            self::apiEndpointUrl($endpoint),
            $pathParam
        );
        var_dump($body);
        try {
            $client = new Client();
            $response = $client->post($constructedUrl, [
                'headers' => self::getHeaders($token),
                'json' => $body
            ]);
            if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
                echo 'Bad response from server.', $response;
                return null;
            }
            var_dump($response);
            return json_decode($response->getBody());
        } catch (\Exception $error) {
            echo $error;
        }
    }


    /**
     * login(): To authenticate and login to get access token
     * @param string $grant_type Grant Type. Accepts "password"
     * @param string $client_id Client ID -> Get it from Developers page.
     * @param string $client_secret Client Secret -> Get it from Developers page.
     * @param string $username Username -> Email account used to Signup for Meet Hour
     * @param string $password Password -> Password of your Meet Hour account.
     * @return mixed response data that we get from API.
     */
    public function login($body) {
        return self::postFetch('', 'login', $body);
    }

    /**
     * getRefreshToken(): To get new token from refresh token
     * @param string $token access token to make API calls.
     * @param mixed $body API call body.
     * @return mixed response data that we get from API.
     */
    public static function getRefreshToken(string $token, $body) {

        return self::postFetch($token, 'refresh_token', $body);
    }

    /**
     * userDetails(): For making Post HTTP Methods via Guzzle.
     * @param string $token access token to make API calls.
     * @return mixed response data that we get from API.
     */
    public static function userDetails(string $token) {
        return self::postFetch($token, 'user_details', '');
    }

     /**
     * generateJwt() : JWT is needed to join the meeting with user information. Usually used if Moderator is joining.
     * @param {string} token - access token to make API calls.
     * @param {any} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function generateJwt($token, $body) {
        return self::postFetch($token, 'get_jwt', $body);
    }

    /**
     * addContact() : To add contact in Meet Hour Database.
     * @param {string} token - access token to make API calls.
     * @param {any} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function addContact($token, $body) {
        return self::postFetch($token, 'add_contact', $body);
    }

    /**
     * timezone() : To get all the timezones used in Meet Hour while Meeting is being Scheduled.
     * @param {string} token - access token to make API calls.
     * @returns {string} response data that we get from API.
     */
    public static function timezone($token) {
        return self::postFetch($token, 'timezone', []);
    }

    /**
     * contactsList() : To get all the contacts available on Meet Hour account.
     * @param {string} token - access token to make API calls.
     * @param {ContactsType} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function contactsList($token, $body) {
        return self::postFetch($token, 'contacts_list', $body);
    }

    /**
     * editContact() : To edit a specific contact.
     * @param {string} token - access token to make API calls.
     * @param {any} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function editContact($token, $body) {
        return self::postFetch($token, 'edit_contact', $body);
    }

    
    /**
     * scheduleMeeting() : Function to hit a Schedule Meeting API.
     * @param {string} token - access token to make API calls.
     * @param {array} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function scheduleMeeting($token, ScheduleMeetingType $body)
    {
        return self::postFetch($token, 'schedule_meeting', $body);
    }

    /**
     * upcomingMeetings() : Function to hit a Schedule Meeting API.
     * @param {string} token - access token to make API calls.
     * @param {array} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function upcomingMeetings($token, $body)
    {
        return self::postFetch($token, 'upcoming_meeting', $body);
    }

    /**
     * archiveMeeting() : To get archive Meeting
     * @param {string} token - access token to make API calls.
     * @param {array} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function archiveMeeting($token, $body)
    {
        return self::postFetch($token, 'archive_meeting', $body);
    }

    /**
     * missedMeetings() : To get all the Missed Meeting.
     * @param {string} token - access token to make API calls.
     * @param {array} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function missedMeetings($token, $body)
    {
        return self::postFetch($token, 'missed_meetings', $body);
    }

    /**
     * completedMeetings() : To get all the Completed Meetings.
     * @param {string} token - access token to make API calls.
     * @param {array} body - API call body.
     * @returns {string} response data that we get from API.
     */
    public static function completedMeetings($token, $body)
    {
        return self::postFetch($token, 'completed_meetings', $body);
    }

  /**
 * editMeeting() : To Edit a specific meeting.
 * @param {string} token - access token to make API calls.
 * @param {any} body - API call body.
 * @returns {string} response data that we get from API.
 */
    public static function editMeeting($token, $body) {
        return self::postFetch($token, 'edit_meeting', $body);
    }

    /**
 * viewMeeting() : To get information of specific meeting.
 * @param {string} token - access token to make API calls.
 * @param {any} body - API call body.
 * @returns {string} response data that we get from API.
 */
public static function viewMeeting(string $token, $body) {
        return self::postFetch($token, 'view_meeting', $body);
    }

    /**
 * recordingsList() : To get all the recording list.
 * @param {string} token - access token to make API calls.
 * @param {any} body - API call body.
 * @returns {string} response data that we get from API.
 */
public static function recordingsList(string $token, $body) {
        return self::postFetch($token, 'recordings_list', $body);
    }

}