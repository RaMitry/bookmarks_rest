**API is running on remote server address http://138.201.187.45**
---


ORM-objects
-----------
**Bookmark**:
```code
{
    "id": <int>,
    "url": <string>,
    "created_at": <datetime>,
    "updated_at": <datetime>
}
```
**Comment**:
```code
{
    "id": <int>,
    "bm_id": <int>,
    "ip": <string>,
    "com_text": <string>,
    "ip": <string>,
    "created_at": <datetime>,
    "updated_at": <datetime>
}
```

**BOOKMARKS REST API**
---

**GET /bookmark** - Get the list of last ten bookmarks

Response:
```code
[
    {"id":18,"url":"habrahabr.fu","created_at":"2016-11-07 16:56:26","updated_at":null},
    {"id":17,"url":"habrahabr.fe","created_at":"2016-11-07 16:52:32","updated_at":null},
    {"id":16,"url":"habrahabr.me","created_at":"2016-11-07 16:10:08","updated_at":null},
    {"id":15,"url":"habrahabr.de","created_at":"2016-11-07 14:18:00","updated_at":null},
    {"id":14,"url":"habrahabr.nunu","created_at":"2016-11-07 13:11:40","updated_at":null},
    {"id":13,"url":"habrahabr.nu","created_at":"2016-11-07 10:24:54","updated_at":null},
    {"id":12,"url":"habrahabr.su","created_at":"2016-11-07 10:24:08","updated_at":null},
    {"id":6,"url":"habrahabr.mu","created_at":"2016-11-07 10:23:47","updated_at":"2016-11-07 10:23:47"},
    {"id":5,"url":"habrahabr.ru\/post\/270251\/","created_at":"2016-11-07 10:41:49","updated_at":"2016-11-07 10:41:49"},
    {"id":4,"url":"habrahabr.ru\/company\/plarium\/blog\/301222\/","created_at":"2016-11-07 10:32:44","updated_at":"2016-11-07 10:32:44"}
]
```

**GET /bookmark/{url}** - Get the bookmark with comment via its url.
!N.B> You should cut off "http://" or "https://" part of url.

Response:
```code
{"id":19,"url":"en.wikipedia.org","created_at":"2016-11-07 17:32:55","updated_at":"2016-11-07 17:32:55","comments":[]}
```
Errors codes:
```code
{
  'error' : 'wrong request'
}
```

**POST /bookmark** - Add new bookmark

Request:
```code
{
    "url": "habrahabr.bu"
}
```
Response:
```code
{
  "bm_id": 20
}
```

**POST /comment** - Add new comment.

Request:
```code
{
    "bm_id": "13",
    "com_text": "go_go!"
}
```
Response:
```code
{
  "id": "10"
}
```

Errors codes:
```code
{
  'error' : 'wrong bm_id'
}
```

**PUT /comment/{id}** - Update a comment.

Запрос:
```code
{
    "com_text": "new_new_text"
}
```
Response:
```code
{
  "success": "the comment has been updated"
}
```


Errors codes:
```code
{
  "error": "you have no access or the comment is too old"
}
```

**DELETE /comments/{id}** - Delete a comment.

Response:
```code
{
  "success": "comment has been removed"
}
```


Errors codes:
```code
{
  "error": "you have no access or the comment is too old"
}
```
