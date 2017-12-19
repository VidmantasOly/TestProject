<?php

namespace Tests\Feature;

use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Carbon\Carbon;
use App\Concert;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewConcertListingTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function use_can_view_a_concert_listing()
    {
      // Arrange
      // Create a concert
      $concert = Concert::create([
        'title' => 'The Red Chord',
        'subtitle' => 'with Animosity and Letargy',
        'date' => Carbon::parse('December 13, 2016 8:00pm'),
        'ticket_price' => 3250,
        'venue' => 'The Mosh Pit',
        'venue_adress' => '123 Example Lane',
        'city' => 'Laraville',
        'state' => 'ON',
        'zip' => '17916',
        'additional_information' => 'For tickets, call (555) 555-5555.',
      ]);
// $this->visit('/concerts/'.$concert->id);
      // Act
      // View the concert listing
      $this->browse(function ($browser) use ($user) {
        $browser->visit('/concerts/' . $concert->id)
                -> assertSee('The Red Chord');
                -> assertSee('with Animosity and Letargy');
                -> assertSee('December 13, 2016');
                -> assertSee('8:00pm');
                -> assertSee('32.50');
                -> assertSee('The Mosh Pit');
                -> assertSee('123 Example Lane');
                -> assertSee('Laraville, ON 17916');
                -> assertSee('For tickets, call (555) 555-5555.');
              });

      // Assert
      // See the concert details

    }
}
