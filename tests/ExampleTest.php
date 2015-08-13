<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test user adding a shame.
     *
     * @return void
     */
    public function testAddShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->click('Post a Shame')
            ->seePageIs('/shames/create')
            ->type('Test 1', 'title')
            ->type('Test 1', 'markdown')
            ->type('JavaScript, ', 'tags')
            ->press('Post Shame')
            ->seePageIs('shames/featured')
            ->click('New Shames')
            ->see('Test 1');
    }

    /**
     * Test user editing a shame.
     *
     * @return void
     */
    public function testEditShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('User2', 'display_name')
            ->type('user2@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->click('Post a Shame')
            ->seePageIs('/shames/create')
            ->type('Test 2', 'title')
            ->type('Test 2', 'markdown')
            ->type('PHP, ', 'tags')
            ->press('Post Shame')
            ->seePageIs('shames/featured')
            ->click('Posted Shames')
            ->seePageIs('/shames')
            ->click('Edit')
            ->type('Test 2 Edited', 'title')
            ->type('Test 2 Markdown Edited', 'markdown')
            ->type('JavaScript, ', 'tags')
            ->press('Update Shame')
            ->see('Test 2 Edited')
            ->see('JavaScript')
            ->click('Test 2 Edited')
            ->see('Test 2 Markdown Edited');
    }

    /**
     * Test deleting a shame.
     */
    public function testDeleteShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('User3', 'display_name')
            ->type('user3@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->click('Post a Shame')
            ->seePageIs('/shames/create')
            ->type('Test 3', 'title')
            ->type('Test 3', 'markdown')
            ->check('is_anonymous')
            ->press('Post Shame')
            ->seePageIs('shames/featured')
            ->click('Posted Shames')
            ->seePageIs('/shames')
            ->press('Delete')
            ->notSeeInDatabase('shames', ['title' => 'Test 3']);
    }

    /**
     * Test upvoting a shame.
     */
    public function testUpvoteShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('Justin', 'display_name')
            ->type('justin.j.norris@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured');

        $this->visit('/shames/create')
            ->seePageIs('/shames/create')
            ->type('Test Upvote', 'title')
            ->type('Upvote Me!', 'markdown')
            ->press('Post Shame')
            ->seeInDatabase('shames', ['id' => 1, 'user_id' => 1, 'title' => 'Test Upvote', 'markdown' => 'Upvote Me!']);

        $this->visit('logout')
            ->seePageIs('/shames/featured');

        $this->visit('/login')
            ->type('Mark', 'display_name')
            ->type('mark@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->press('0')
            ->seeInDatabase('upvote_shame', ['user_id' => 2, 'shame_id' => 1]);
    }

    public function testRemoveUpvoteFromShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('Justin', 'display_name')
            ->type('justin.j.norris@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured');

        $this->visit('/shames/create')
            ->seePageIs('/shames/create')
            ->type('Test Upvote', 'title')
            ->type('Upvote Me!', 'markdown')
            ->press('Post Shame')
            ->seeInDatabase('shames', ['id' => 1, 'user_id' => 1, 'title' => 'Test Upvote', 'markdown' => 'Upvote Me!']);

        $this->visit('logout')
            ->seePageIs('/shames/featured');

        $this->visit('/login')
            ->type('Mark', 'display_name')
            ->type('mark@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->press('0')
            ->seeInDatabase('upvote_shame', ['user_id' => 2, 'shame_id' => 1])
            ->press('1')
            ->notSeeInDatabase('upvote_shame', ['user_id' => 2, 'shame_id' => 1]);
    }

    public function testFollowShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('Justin', 'display_name')
            ->type('justin.j.norris@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured');

        $this->visit('/shames/create')
            ->seePageIs('/shames/create')
            ->type('Test Follow Shame', 'title')
            ->type('Follow Me!', 'markdown')
            ->press('Post Shame')
            ->seeInDatabase('shames', ['id' => 1, 'user_id' => 1, 'title' => 'Test Follow Shame', 'markdown' => 'Follow Me!']);

        $this->visit('logout')
            ->seePageIs('/shames/featured');

        $this->visit('/login')
            ->type('Mark', 'display_name')
            ->type('mark@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->press('Follow')
            ->seeInDatabase('follow_shame', ['user_id' => 2, 'shame_id' => 1]);
    }

    public function testUnfollowShame()
    {
        $this->seed();

        $this->visit('/login')
            ->type('Justin', 'display_name')
            ->type('justin.j.norris@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured');

        $this->visit('/shames/create')
            ->seePageIs('/shames/create')
            ->type('Test Follow Shame', 'title')
            ->type('Follow Me!', 'markdown')
            ->press('Post Shame')
            ->seeInDatabase('shames', ['id' => 1, 'user_id' => 1, 'title' => 'Test Follow Shame', 'markdown' => 'Follow Me!']);

        $this->visit('logout')
            ->seePageIs('/shames/featured');

        $this->visit('/login')
            ->type('Mark', 'display_name')
            ->type('mark@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->press('Follow')
            ->seeInDatabase('follow_shame', ['user_id' => 2, 'shame_id' => 1])
            ->press('Unfollow')
            ->notSeeInDatabase('follow_shame', ['user_id' => 2, 'shame_id' => 1]);
    }

    public function testViewFeaturedShames()
    {
        $this->seed();

        $this->visit('/login')
            ->type('Justin', 'display_name')
            ->type('justin.j.norris@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured');

        $this->visit('/shames/create')
            ->seePageIs('/shames/create')
            ->type('Test Shame', 'title')
            ->type('Test Body', 'markdown')
            ->press('Post Shame')
            ->seeInDatabase('shames', ['id' => 1, 'user_id' => 1, 'title' => 'Test Shame', 'markdown' => 'Test Body']);

        $this->visit('logout')
            ->seePageIs('/shames/featured')
            ->click('Featured Shames')
            ->seePageIs('/shames/featured')
            ->see('Test Shame');
    }

    public function testViewTopShames()
    {
        $this->seed();

        $this->visit('/login')
            ->type('Justin', 'display_name')
            ->type('justin.j.norris@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured');

        $this->visit('/shames/create')
            ->seePageIs('/shames/create')
            ->type('Test Shame', 'title')
            ->type('Test Body', 'markdown')
            ->press('Post Shame')
            ->seeInDatabase('shames', ['id' => 1, 'user_id' => 1, 'title' => 'Test Shame', 'markdown' => 'Test Body']);

        $this->visit('logout')
            ->seePageIs('/shames/featured')
            ->click('Top Shames')
            ->seePageIs('/shames/top')
            ->see('Test Shame');
    }

    public function testViewRandomShamesAnonymous()
    {
        $this->visit('/shames/random');
    }

    public function testViewRandomShamesAuthenticated()
    {
        $this->visit('/login')
            ->type('Dwight', 'display_name')
            ->type('dwightregire@yahoo.com', 'email')
            ->type('manman55', 'password')
            ->type('manman55', 'password_confirmation')
            ->press('Register');
        $this->visit('/shames/random');
    }

    public function testViewNewShamesAnonymous()
    {
        $this->visit('/shames/new');
    }

    public function testViewNewShamesAuthenticated()
    {
        $this->visit('/login')
            ->type('Dwight', 'display_name')
            ->type('dwightregire@yahoo.com', 'email')
            ->type('manman55', 'password')
            ->type('manman55', 'password_confirmation')
            ->press('Register');
        $this->visit('/shames/new');
    }

    public function testAddCommentAnonymous()
    {
        $this->visit('/login')
            ->type('Dwight', 'display_name')
            ->type('dwightregire@yahoo.com', 'email')
            ->type('manman55', 'password')
            ->type('manman55', 'password_confirmation')
            ->press('Register');
        $this->visit('/shames/create')
            ->type('test1','title')
            ->type('test','markdown')
            ->press('Post Shame');
        $this->visit('/logout');
        $this->visit('/shames/1')
            ->type('the test of comments','text')
            ->press('Submit');
    }

    public function testAddCommentAuthenticated()
    {

        $this->visit('/login')
            ->type('Dwight', 'display_name')
            ->type('dwightregire@yahoo.com', 'email')
            ->type('manman55', 'password')
            ->type('manman55', 'password_confirmation')
            ->press('Register');
        $this->visit('/shames/create')
            ->type('test1','title')
            ->type('test','markdown')
            ->press('Post Shame');
        $this->visit('/shames/1')
            ->type('the test of comments','text')
            ->press('Submit');

    }

    public function testUpvoteComment()
    {
        $this->visit('/login')
            ->type('Dwight', 'display_name')
            ->type('dwightregire@yahoo.com', 'email')
            ->type('manman55', 'password')
            ->type('manman55', 'password_confirmation')
            ->press('Register')
            ->visit('/shames/create')
            ->type('test1','title')
            ->type('test','markdown')
            ->press('Post Shame')
            ->visit('/shames/1')
            ->type('the test of comments','text')
            ->press('Submit')
            ->visit('/shames/1')
            ->press('0')
            ->seePageIs('/shames/1');
    }

    public function testRemoveUpvoteFromComment()
    {
        $this->visit('/login')
            ->type('Dwight', 'display_name')
            ->type('dwightregire@yahoo.com', 'email')
            ->type('manman55', 'password')
            ->type('manman55', 'password_confirmation')
            ->press('Register')
            ->visit('/shames/create')
            ->type('test1','title')
            ->type('test','markdown')
            ->press('Post Shame')
            ->visit('/shames/1')
            ->type('the test of comments','text')
            ->press('Submit')
            ->visit('/shames/1')
            ->press('0')
            ->seePageIs('/shames/1')
            ->press('1');
    }

    /**
     * Test successful registration.
     *
     * @return void
     */
    public function testRegisterForAccountSuccess()
    {
        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@ymail.com', 'email')
            ->type('conestoga', 'password')
            ->type('conestoga', 'password_confirmation')
            ->press('Register')
            ->visit('/shames')
            ->seeInDatabase('users',['display_name' => 'User1',
                'email' => 'user1@ymail.com']);
    }

    /**
     * Test unsuccessful registration.
     *
     * @return void
     */
    public function testRegisterForAccountIncorrectInput()
    {
        $this->visit('/login')
            ->type('', 'display_name')
            ->type('', 'email')
            ->type('', 'password')
            ->type('', 'password_confirmation')
            ->press('Register')
            ->see('<li>The display name field is required.</li>')
            ->see('<li>The email field is required.</li>')
            ->see('<li>The password field is required.</li>');
    }

    /**
     * Test unsuccessful registration.
     *
     * @return void
     */
    public function testRegisterForAccountMismatchedPasswords()
    {
        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@ymail.com', 'email')
            ->type('conestoga', 'password')
            ->type('conestoga1', 'password_confirmation')
            ->press('Register')
            ->see('<li>The password confirmation does not match.</li>');
    }

    /**
     * Test unsuccessful registration.
     *
     * @return void
     */
    public function testRegisterForAccountUserNameEmailExists()
    {
        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@ymail.com', 'email')
            ->type('conestoga', 'password')
            ->type('conestoga', 'password_confirmation')
            ->press('Register')
            ->visit('/logout');

        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@ymail.com', 'email')
            ->type('conestoga', 'password')
            ->type('conestoga', 'password_confirmation')
            ->press('Register')
            ->see('<li>The display name has already been taken.</li>')
            ->see('<li>The email has already been taken.</li>');
    }

    /**
     * Test logout and auth redirection.
     *
     * @return void
     */
    public function testLogOut()
    {
        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->visit('/logout')
            ->visit('/shames')
            ->seePageIs('/login');
    }

    /**
     * Test successful login.
     *
     * @return void
     */
    public function testLoginCorrectInput()
    {
        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->visit('/logout');

        $this->visit('/login')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->visit('/shames')
            ->seePageIs('/shames');
    }

    /**
     * Test unsuccessful login.
     *
     * @return void
     */
    public function testLoginIncorrectInput()
    {
        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->visit('/logout');

        $this->visit('/login')
            ->type('user1@gmail.com', 'email')
            ->type('passwor', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('<li>These credentials do not match our records.</li>');
    }

    /**
     * Test viewing of own posted shames.
     *
     * @return void
     */
    public function testViewPostedShames()
    {
        $this->seed();

        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->click('Post a Shame')
            ->seePageIs('/shames/create')
            ->type('Test 1', 'title')
            ->type('Test 1', 'markdown')
            ->type('JavaScript, ', 'tags')
            ->press('Post Shame')
            ->visit('/shames')
            ->click('Test 1')
            ->seePageIs('/shames/1');
    }

    /**
     * Test view posted comments.
     *
     * @return void
     */
    public function test_View_Posted_Comments()
    {
        $this->seed();

        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/shames/featured')
            ->click('Post a Shame')
            ->seePageIs('/shames/create')
            ->type('Test 1', 'title')
            ->type('Test 1', 'markdown')
            ->type('JavaScript, ', 'tags')
            ->press('Post Shame')
            ->visit('/shames/1')
            ->type('Comment Test', 'text')
            ->press('Submit')
            ->seeInDatabase('comments', ['id' => '1',
                'text' => 'Comment Test',
                'user_id' => '1',
                'shame_id' => '1']);
    }

    /**
     * Test the viewing of badges.
     *
     * @return void
     */
    public function testViewsBadges()
    {
        $this->seed();

        $this->visit('/login')
            ->type('User1', 'display_name')
            ->type('user1@gmail.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->visit('/badges')
            ->seePageIs('/badges');
    }
}
