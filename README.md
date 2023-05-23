# Communication module for laravel project

## Installation

```
composer require d3cr33/communication @dev
```

## What It Does

This package allows you to manage a project communication.

Once installed you can do stuff like this:

```
(new CommunicationService)->execute(#communicationData);
```

communicationData can be filled like this :

```
$communicationData = [
    service,
    port,
    model_type,
    model_id,
    template,
    template_data,
    receiver_data,
    send_at, 
    thread,
    callback, 
    callback_data,
]

service:
Type = INT
Description = Send via which service.

port: 
Type: INT
Description: Send via which service port's.

model_type:
Type: STRING
Description: trigger from which model ( can store like, namespace, ...).

model_id:
Type: STRING
Description: unique id for model_type.

template:
Type: STRING
Description: message that must be send.

template_data:
Type: ARRAY
Description: template data that replace in template.

receiver_data:
Type: ARRAY
Description: data that used in a communication service like mobile , ...

send_at
Type: TIMESTAMP
Description: when fired

thread
Type: INT
Param: 1: Sync - 2: Async

callback
Type: STRING
Description: callback event namespace when send successfuly

callback_data
Type: ARRAY
Description: data that used in a callback
```