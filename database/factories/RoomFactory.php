<?php

namespace Database\Factories;

use App\Models\Floor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $jokes = ['The only question: Does Chuck Norris have to choke a bitch?', 'the movie "dont mess with zohan" is based on the true story of Chuck Norris\' life', 'The limit of Chuck Norris as he approaches infinity does not exist because Chuck Norris has no limits.', "If you sneeze on Chuck Norris, He'll sneeze at you back. Which will blow you away.", 'Chuck Norris will only eat a Plantain Split.', 'For Chuck Norris, NP-Hard = O(1).', 'Chuck Norris used to throw shoes at Dubya all the time.', "How's your life Chuck Norris?", 'Everyone is born naked and crying, except Chuck Norris. Chuck Norris was born dressed as a little soldier, and came out marching.', 'If you find Chuck Norris while playing hide and seek, you lose.', 'Apparently, somebody must have told Mr. Ed that Chuck Norris named his one-eyed warrior Willlllbur.', 'Chuck Norris starred in all the 6 Star Wars&#65279; films... as the Force.', 'Chuck Norris can send a text massage through public telephone', 'Chuck Norris put 5 of his good friends in the hospital, after they challenged him to a pillow fight.', 'The term absolute zero refers to the number of people who will survive if Chuck Norris decides to go on an all-out killing rampage.', 'When Chuck Norris was denied a Bacon McMuffin at McDonalds because it was 10:35, he roundhouse kicked the store so hard it became a KFC.', 'Weed should be legal cause i smoke it and so does Chuck Norris', "Chuck Norris invented Kotex MaxiPads. Originally they were used in hospital ER's to stop profuse bleeding from any part of his victim's body.", "Helen Keller's favorite color is Chuck Norris.", 'When someone says "nobody\'s perfect", you are insulting Chuck Norris', 'One Million years ago Chuck Norris slapped the world, and to this day it is still spinning', "It doesn't matter what those bitch-ass Rolling Stones say, Chuck Norris CAN always get what he wants.", 'Chuck Norris can whistle underwater.', 'If he wanted to, Chuck Norris could give himself a barium enema with his own dick.', 'Chuck Norris got mad at some vegetables, the end results were Black-eyed peas.', 'Chuck Norris doesnt mingle. he mangles.', 'Chuck Norris can sing bohemian rhapsody with his farts.', 'Scientists use pictures of Chuck Norris to get panda bears horny.', 'Chuck Norris got the new Galaxy Foamposites for free.', 'Chuck Norris Installed linux in his sand watch', "Chuck Norris' parents are named after him", "The head of Chuck Norris' penis has knuckles.", "Once upon a time, there was a warrior. He was destined to save the earth from all evils. That man was not Chuck Norris, because Chuck ate that man. Don't piss him off.", "Michael Jackson didn't have a rare skin disease.... Chuck Norris beat the black outa him.. ..at Michael's request. The injuries were so severe it required several years of intense surgery.", 'When Chuck Norris was told that a nuke was coming his way he said "everyone get behind me you\'ll be safe."', 'Once Chuck Norris installed an internet in his windmill.', "Chuck Norris gets more ass than a toilet seat at the Irritable Bowel Syndrome Sufferer's annual national convention", 'Chuck Norris went to the super bowl with only himself.', 'Chuck Norris and Rodney Mullen were skateboarding in Singapore. Rodney got fined, and Chuck got paid', 'Some of the alternate titles - The Expendables 2: Chuck Norris Forever, The Expendables 2: Norris And Friends, The Chuckpendables, Big Chuck And Some Ugly Overpaid Motherfuckers, and Walker: Texas Ranger: The Motion Picture.', 'Chuck Norris can pee in the pool without getting caught.', 'Hitler killed himself the year Chuck Norris died... COINIDENCE?!?!?!', 'Chuck Norris can overflow your stack just by looking at it.', 'Everyone is born naked and crying, except Chuck Norris. Chuck Norris was born dressed as a little soldier, and came out marching.', 'When the Lone Ranger & Tonto challenged Chuck Norris to a game of 8 ball, Chuck Norris racked thier balls.', 'Chuck Norris can cast Tenth Level Spells under First Edition rules.', "At the dawn of time, Chuck Norris and Mr. T sat in an empty universe, bored with nothing to destroy, so they decided to arm wrestle. The competition began - it raged on for days and days, with thunderclaps of pure energy jolting off of their bulging muscles, ripping holes through reality, and creating the universe as we know it. Finally, after much-ado, and with one emphatic thud, Mr. T beat Chuck Norris at arm wrestling... ...And thus, Chuck Norris invented racism, and roundhouse kicked Mr. T into a bad 1980's TV show.", 'Chuck Norris can speak French in Russian', 'The recent financial debacle was not due subprime mortgage lending and the housing bubble bursting. The real reason was Chuck Norris stopped lending to banks.',
        'Chuck Norris can ride a BMX bike while wearing bigass MC Hammer parachute pants.'];

    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1, 100),
            "name" => $this->faker->text(60),
            'floor_id' => Floor::factory(),
            'description' => $this->jokes[array_rand($this->jokes)],
            "is_available" => true
        ];
    }
}
