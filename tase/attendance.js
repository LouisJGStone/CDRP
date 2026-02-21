function state(state, user) {

              if (state == "Present") {

                $("#td" + user).html('<span class="label label-sm bg-green-turquoise"> Present </span>');

              }

              if (state == "Absent") {

                $("#td" + user).html('<span class="label label-sm bg-red-thunderbird"> Absent </span>');

              }

              if (state == "LOA") {

                $("#td" + user).html('<span class="label label-sm bg-yellow-saffron"> LOA </span>');

              }

              if (state == "Late") {

                $("#td" + user).html('<span class="label label-sm bg-red-pink"> Late </span>');

              }

              var data = {
                "mark": "true",
                "user": user, 
                "state": state
              };

              jQuery.post("attendance.php", data);
}