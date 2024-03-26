<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Fish;

class AjaxController extends Controller
{
    public function handleRequest($route)
    {
        // Implement logic for handling different AJAX routes
        $elements = "";
        $background = "";
        $autoTransitionLength = 0;
        $autoTransitionDestination = "";
        $redirectTo = "";
        $dialogue = null;
        $isLeftShard = false;
        $isCenterShard = false;
        $isRightShard = false;

        switch ($route) {
            case 'start':
                /*
                if (Auth::check()) {
                    //$background = "./images/cabin-interior.webp";
                    //continue to cabin or last known location
                    $redirectTo = route($user->getLastPage());
                } else {
                    //$background = './images/pftf-cabin.gif';
                    $elements = view('auth.register')->render();
                }
*/
/*                $dialogue = [
                    'text' => "<span class='speaker'>???</span> The cabin looks to be in great shape. Nothing a little dusting won't fix.<br />I better get ready for the day.",
                    'options' => [
                        ['text' => 'Press P to prepare for the day', 'action' => 'mirror'],
                        ['text' => 'Quit Game', 'action' => 'quitGame'],
                    ],
                ];

                $elements = '
                    <h1 class="animate-text amarante-regular" data-destination="leave-cabin-left" style="left:250px; top: -90px;">Type "fish" to fulfill your purpose</h1>
                    <h1 class="animate-text amarante-regular" data-destination="leave-cabin-left" style="left:450px; top: -30px;">Type "survey" to get your bearings</h1>
                    <h1 class="animate-text amarante-regular" data-destination="leave-cabin-left" style="left:450px; top: -30px;">Type "dust" to dust the room</h1>
                
                ';
*/
                $elements = "";
                $background = "./images/off-to-fish.webp";
                $autoTransitionLength = 2;
                $redirectTo = "cabin";
                $isCenterShard = true;
                /*
                if (Auth::check()) {
                    $elements = "
                        <h1 class='animate-text amarante-regular' data-key-param='{\"a\":\"survey-surroundings\"}' style='left:250px; top: -90px;'>Press C to Continue</h1>
                    ";
                }
                */
                break;
            case 'survey':
                $elements = view('feature')->render();
                $background = "./images/world-overview.jpg";
                $isCenterShard = true;
                break;
            case 'cabin':
                $elements = view('cabin')->render();
                $background = "./images/cabin-interior-clean-table.jpg";
                $isCenterShard = true;
                break;
            case 'cabin-after-survey':
                $elements = '
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="input-container">
                                <input type="text" id="game-input" placeholder="Type mirror to center yourself...">
                                <span class="enter-icon">&#8629;</span>
                            </div>
                        </div>
                    </div>
                    <div class="shard-container">
                        <div class="shard-slice shard-left deg-minus-45"></div>
                        <div class="shard-slice shard-center"></div>
                        <div class="shard-slice shard-right deg-45"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div id="dialogue-container">
                                <div class="row">
                                    <div class="col-4">
                                        <p id="leftChoiceLabel" class="choice-label">Type "tidy" to get rid of that awful smell</p>
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-4">
                                        <p id="rightChoiceLabel" class="choice-label">Type "fish" to find your purpose</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                $background = "/images/cabin-interior.webp";
                break;
            case 'mirror-used':
                $elements = "
                    <h1 class='animate-text amarante-regular' data-key-param='{\"l\":\"leave-cabin\"}' style='right:60px; position:absolute;'>Press L to Leave</h1>
                ";
                $background = "./images/cabin-interior.webp";
                break;
            case 'fish':
                $elements = "";
                $background = "./images/off-to-fish.webp";
                $autoTransitionLength = 2;
                $autoTransitionDestination = "interior-fish";
                $isCenterShard = true;
                break;
            case 'mirror':
                $elements = "";
                $background = "./images/off-to-fish.webp";
                $isLeftShard = true;
                $redirectTo = route('mirror');
                break;
            case 'login':
                if (Auth::check()) {
                } else {
                    $elements = view('auth.login')->render();
                }
                break;        
            case 'interior-fish':
                $elements = "<h1 class='animate-text amarante-regular text-center' id='pressFtoFishText' data-key-param='{\"f\":\"attempt-fish\"}'>Press F to Fish</h1>";
                $background = "./images/fishing-view.webp";
                break;
            case 'attempt-fish':
                //run random fish attempt, include livewell storage $this->attemptFish($livewell)
                $elements = view('fishing')->render();
                break;
            default:
                // Handle unknown routes
                $elements = '<h1>Unknown Route</h1>';
                $background = "./images/pftf-cabin.gif";
        }

        return response()->json([
            'elements' => $elements,
            'background' => $background,
            'autoTransition' => $autoTransitionLength,
            'autoTransitionDestination' => $autoTransitionDestination,
            'redirectTo' => $redirectTo,
            'dialogue' => $dialogue,
            'isLeftShard' => $isLeftShard,
            'isCenterShard' => $isCenterShard,
            'isRightShard' => $isRightShard
        ]);
    }

    public function getRandomFish()
    {
        // Retrieve a random fish from the database
        $fish = Fish::inRandomOrder()->first();
    
        // Return the fish details
        return response()->json([
            'id' => $fish->id,
            'name' => $fish->name,
            'latin_name' => $fish->latin_name,
            'description' => $fish->description,
            'image_url' => $fish->image_url,
            'further_reading' => $fish->further_reading
        ]);
    }

    public function storeFish($livewell)
    {
        if ($livewell <= 7) {
            //store fish only when space allows
            //assign fish space in livewell
        }
    }
}
