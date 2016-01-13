# Slack cleaner

Used for deleting direct messages from some user or bot. Now it's available only by API.

# How to clean messages

- find bot ID at https://api.slack.com/methods/im.list/test or 
- find user ID at https://api.slack.com/methods/users.list/test
- insert ID to script as `$channelName`
- on https://api.slack.com/methods/auth.test/test click to Test Method
- copy `token` parameter from generated URL
- insert token to script as `$token` parameter
- run `composer install`
- run script