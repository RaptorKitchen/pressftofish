<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Fish;

class AjaxController extends Controller
{
    public function handleRequest($route, $caveStatus = null)
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
        $bodyBackground = "url(/images/regal.png), linear-gradient(to bottom, #feefcc 0%, #1f130c 80%);";
        $bodyBackgroundRepeat = "repeat, no-repeat;";

        switch ($route) {
            case 'home':
                $elements = view('welcome')->render();
                $background = "./images/pftf-cabin.gif";
                break;
            case 'start':
                $elements = "";
                $background = "./images/off-to-fish.webp";
                $autoTransitionLength = 2;
                $redirectTo = "cabin";
                $isCenterShard = true;
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
            case 'leave':
                $elements = "";
                $isLeftShard = true;
                $background = "./images/off-to-fish-night.jpg";
                $autoTransitionLength = 2;
                $autoTransitionDestination = "cave";
                $caveStatus = 'left';
                break;
            case 'take':
                $elements = "";
                $isCenterShard = true;
                $background = "./images/off-to-fish-night.jpg";
                $autoTransitionLength = 2;
                $autoTransitionDestination = "cave";
                $caveStatus = 'taken';
                break;
            case 'feed':
                $elements = "";
                $isRightShard = true;
                $background = "./images/off-to-fish-night.jpg";
                $autoTransitionLength = 2;
                $autoTransitionDestination = "cave";
                $caveStatus = 'fed';
                break;
            case 'cave':
                $elements = "";
                $background = "linear-gradient(to bottom, #182644 0%, #514960 50%, #0c011b 80%)";
                $elements = view('cave')->render();
                $isCave = true;
                break;
            case 'cave/left':
                $elements = "";
                $background = "linear-gradient(to bottom, #182644 0%, #514960 50%, #0c011b 80%)";
                $elements = view('cave')->render();
                $isCave = true;
                $caveStatus = 'left';
                break;
            case 'cave/taken':
                $elements = "";
                $background = "linear-gradient(to bottom, #182644 0%, #514960 50%, #0c011b 80%)";
                $elements = view('cave')->render();
                $caveStatus = 'taken';
                $isCave = true;
                break;
            case 'cave/fed':
                $elements = "";
                $background = "linear-gradient(to bottom, #182644 0%, #514960 50%, #0c011b 80%)";
                $elements = view('cave')->render();
                $isCave = true;
                $caveStatus = 'fed';
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
            'isRightShard' => $isRightShard,
            'bodyBackground' => $bodyBackground,
            'bodyBackgroundRepeat' => $bodyBackgroundRepeat,
            'caveStatus' => $caveStatus ?? null,
            'isCave' => $isCave ?? null
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
