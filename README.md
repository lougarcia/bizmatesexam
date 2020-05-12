# PART 1

### About Implementation

- I have made a simple "two-page" app for easy navigation.
- The small widgets shows the minimum data a user requires to check the current weather.
- More weather information is shown when user clicks on a widget.
- Foursquare search results is also loaded

### Notes:

- If I would redo this, I'd include the daily weather data in the home page widgets with Day, Temperature, Weather/Icon
- Also add a link to Foursquare at the middle-bottom of the widget which will open a dialog box of search results

OR

- City name, current weather and temperatue on the top
- A scrolling list of foursquare search result in the body of the widget

# PART 2

### Query 1
```sql
SELECT
	CONCAT('T', LPAD(tt.id, 11, '0')) AS ID,
    tt.nickname AS Nickname,
    GROUP_CONCAT(DISTINCT
		CONCAT(
			CASE WHEN tt.status = 0 THEN 'Discontinued'
            ELSE CONCAT(
				CASE WHEN tt.status = 1 THEN 'Active' 
					ELSE 'Deactivated' END
				) END
			)
		) AS Status,
    GROUP_CONCAT(DISTINCT
		CONCAT(
			CASE WHEN ttr.role = 1 THEN 'Trainer'
            ELSE CONCAT(
				CASE WHEN ttr.role = 2 THEN 'Assessor' 
					ELSE 'Staff' END
				) END
			)
		SEPARATOR '/' 
		) AS Roles
FROM
	trn_teacher tt
LEFT JOIN trn_teacher_role ttr
	ON tt.id = ttr.teacher_id
GROUP BY
	tt.id;
```

### Query 2
This still has duplicates and not yet filtered by roles
```sql
SELECT
	tt.id AS ID,
    tt.nickname AS Nickname,
    SUM(
		CONCAT(
			CASE WHEN ttt.status = 1 THEN 1 ELSE 0 END
		)
    ) AS Open,
    SUM(
		CONCAT(
			CASE WHEN ttt.status = 3 THEN 1 ELSE 0 END
		)
    ) AS Reserved,
    SUM(
		CONCAT(
			CASE WHEN te.result = 1 THEN 1 ELSE 0 END
		)
    ) AS Taught,
    SUM(
		CONCAT(
			CASE WHEN te.result = 2 THEN 1 ELSE 0 END
		)
    ) AS NoShow
FROM trn_teacher tt
LEFT JOIN trn_time_table ttt
	ON tt.id = ttt.teacher_id
LEFT JOIN trn_evaluation te
	ON tt.id = te.teacher_id
GROUP BY tt.id
```
