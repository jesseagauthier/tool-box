<?php

/*** set the content type header ***/
/*** Without this header, it wont work ***/
header("Content-type: text/css");

?>

body {
background-color: rgb(237, 233, 233);
}

#submit, #login {
all: unset;
background-color: black;
color: white;
padding: .50em;
cursor: pointer;
}



#submit:hover {
background-color: white;
color: black;
border: 2px solid black;
}

.project-summary {
width: 100%;
border-spacing: 30px;
}


.project-summary thead tr {
width: fit-content;
}

.project-summary th {
font-weight: bold;
font-size: 1rem;
margin: 0 4em;
}

.project-summary th,tr,td {
padding: 0em .40em;
border: 3px solid black;
}

form {
display: flex;
flex-wrap: wrap;
justify-content: center;
align-content: center;
}


form label,input {
width: 50%;
}

input {
margin: .50em 0;
}

#submit, #login {
margin: 1em 0;
}

@media screen and (min-width: 766px) {

form, .project-summary {
width: 80%;
margin: 0 auto;
border-spacing: 30px;
}

form {
width: 40%;
}




form label,input,select {
width: 100%;
}
}

.error-message {
width: 100%;
text-align: center;
color: red;
}