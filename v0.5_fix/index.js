/* LOGIN PHP DEMO */
function loginswitch()
{
	document.getElementsByClassName("navbar_auth")[0].style.display = "none";
	document.getElementsByClassName("navbar_loggedin")[0].style.display = "flex";
}

/* APTLIST & RESULTLIST */
list_el_id_active = 0;
list_els = document.getElementsByClassName("list_el");
for (i = 0; i < list_els.length; i++)
{
	let list_el = list_els[i];
	list_el.addEventListener("click", 
		function(event)
		{
			if ((event.target.tagName != 'P') && (event.target.tagName != 'A'))
			{
				if ((list_el.getElementsByClassName("pfp")[0].id + '_' == list_el_id_active) && (document.getElementsByClassName("secondary")[0].style.display == "flex"))
				{
					document.getElementsByClassName("secondary")[0].style.display = "none";
				}
				else
				{
					document.getElementsByClassName("secondary")[0].style.display = "flex";
					list_el_id_active = list_el.getElementsByClassName("pfp")[0].id + '_';
				}
				console.log(list_el_id_active);
			}
		}
	);
}

/* BOOKFORM */
formnum = 0;
description = "Motif inconnu.";
datetime = {
	month_name: "0",
	day_name: "0",
	day_num: 0,
	time: "0",
}
function nextform(opt)
{
	el = document.getElementsByClassName("bookform_container")[0].children;
	if (opt == 1)
	{
		el[formnum].classList.add("hidden");
		formnum = 0;
		el[formnum].classList.remove("hidden");
	}
	else
	{
		el[formnum].classList.add("hidden");
		el[++formnum].classList.remove("hidden");
	}
	saveform()
}
function saveform()
{
	bookform_body_ta = document.getElementsByClassName("bookform_body_ta")[0];
	setdatetime()
	if (bookform_body_ta.value != "")
	{
		description = document.getElementsByClassName("bookform_body_ta")[0].value;
	}
	document.getElementsByClassName("bookform_result")[0].innerHTML = "RDV pour le " + datetime.day_name + " " + datetime.day_num + " " + datetime.month_name + " a " + datetime.time + "\nMotif: " + description;
}
function setdatetime()
{
	const MONTHS = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
	const DAYS = ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"];
	datetime_in = document.getElementById("datetime_in").value;
	datetime_in_obj = new Date(datetime_in);
	datetime.month_name = MONTHS[datetime_in_obj.getMonth()];
	datetime.day_name = DAYS[datetime_in_obj.getDay()];
	datetime.day_num = datetime_in_obj.getDate();
	datetime.time = datetime_in_obj.getHours() +  ':' + datetime_in_obj.getMinutes();
}