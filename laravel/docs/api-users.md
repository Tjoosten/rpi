[API] Users:
==========================

## Endpoints

The user part of the APi has the following endpoints.

| Endpoint:       | `GET` | `POST`| `PATCH`| `DELETE` |
| ------------- | ----- | ----- | ------ | -------- |
| `/user/all`   | YES   | -     | -      | -        |
| `/user/insert`| -     | YES   | -      | -        |
| `/user{id}`   | YES   | -     | -      | YES      |

## Headers

The API support the following HTTP Header:

| Format: | MIME Type:         |
| ------- | ------------------ |
| `JSON`  | `application/json` |
| `YAML`  | `text/yaml`        |

## Endpoints

###*/user/all*

**Method:** `GET`
**Header(s):** `application/json`, `text/yaml`
**Rights:** Administrator
