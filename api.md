# API Documentation

Base URI: /api

==========================================================
## Get Student
  This will retrieve all religions
Method: GET
URL: /api/students/

## CREATE NEW STUDENT

Method: POST
URL: /api/students
parameter: {
 'name','email','phone','whatsapp_number','pass_outyear','city','pin' 
}

=============================================================
## UPDATE STUDENT
  This will retrieve all degree
Method: PUT
URL: /api/students/{id}
 {id} = is edit student id
parameter: {
 'name','email','phone','whatsapp_number','pass_outyear','city','pin' 
}

=============================================================
## DELETE STUDENT
  This will retrieve all degree
Method: DELETE
URL: /api/students/{id}
 {id} = is edit student id

 ## PAGES MANAGEMENT
  Find page by 
  URL: /api/pages/find/{slug}
