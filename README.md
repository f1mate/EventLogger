# EventLogger
Using EventLogger, you can make text log files, at your desired page in your PHP projects.

# How to use

1. Include F1Mate/EventLogger.php page into your desired page.
2. Create object for it.
    * $eventLogger = new EventLogger();
3. Call function and set event name as 1st param and your message as your 2nd param.
    * $eventLogger->success()->log('Internet Tools', 'HTTP Status - Page Opened.');

# Thank you, Happy Coding
