# consumer
source code of transaction request consumer(api)

#System components

````
 --------                           -----------             -----------           -------------       -------
|         |                        |           |           |           |         |             |     |       |
| HAProxy | ---------------------->|  Apache   |  -------->| PHP/FPM   | ------->| beanstalkd  |---->|worker |
|         |         |              |           |           |           |         |             |     |       |
 ---------          |               -----------             -----------           -------------       -------
                    |                                                                                     | 
                    |               -----------                ---------             -------              |
                    |              |            |             |         |           |       |             |
                     ------------->| socket.io  | <---------- | PUBLISH |<----------| Redis |<------------   
                                   |  server    |             |         |           |       |
                                    ------------               ----------            -------
                                    
```

Each component runs as a dockerized application.


