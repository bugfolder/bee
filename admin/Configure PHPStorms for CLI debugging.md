# Configure PHPStorms for CLI debugging of b

Here's how to configure PHPStorm to debug CLI utilities, using `b` as an example.

* Create the project.

* Go to Run/Debug Configurations (dropdown at the top of the window).

* Select PHP Script.

* Click "Create Configuration"

    * Give it a name (e.g., b)
    * Under Command Line, set Interpreter to PHP (7.3.21), which is the MAMP version of PHP.
    * Click on the 3 dots at the right to open the "CLI Interpreters" window.
        * For PHP executable, it should show the path to the MAMP PHP executable.
        * Below that, it should also show the Debugger: Xdebug 2.9.6.
        * If not, click the "Open in Editor" link for the php.ini file and follow PHPStorms instructions for configuring php.ini to use XDebug.


Useful PHPStorms links:

[Debugging a CLI Script](https://www.jetbrains.com/help/phpstorm/debugging-a-php-cli-script.html)

[Configuring XDebug](https://www.jetbrains.com/help/phpstorm/configuring-xdebug.html)

Note: In PHPStorms Preferences, under PHP > Debug, there are settings to "Force break at first line..." We can set this, but don't have to.

