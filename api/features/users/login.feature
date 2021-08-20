@ui @javascript
Feature: Signing in to eoffice
    In order to use application
    As an employee
    I should able to log in to the application

    Background:
        Given there is a user "login@example.com" identified by "login"

    @ui @javascript
    Scenario: Sign in with username
        When I want to login
        Then the response status code should be 200
        #Then I should see "test"
        #And I specify the username as "admin"
        #And I specify the password as "password"
        #And I log in
        #Then I should be logged in
