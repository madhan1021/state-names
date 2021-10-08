import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ServerService {
  private http = new HttpHeaders().set("Content-Type","appliction/json").set("Accept","appliction/json");
  constructor(private Http :  HttpClient) { }
  stname(data:any){
      return this.Http.post(
        environment.apiurl +"data-server.php",
        data,
        {headers: this.http , params : new HttpParams().set("stname","true") }
      )
    }
   table_data(data:any){
    return this.Http.post(
      environment.apiurl +"data-server.php",
      data,
      {headers: this.http , params : new HttpParams().set("table","true") }
    )
   }

   edit(data:any){
    return this.Http.post(
      environment.apiurl +"data-server.php",
      data,
      {headers: this.http , params : new HttpParams().set("edit","true") }
    )
   }
   onRemove(data:any){
    //  console.log(data);

    return this.Http.post(
      environment.apiurl +"data-server.php",
      data,
      {headers: this.http , params : new HttpParams().set("remove","true") }
    )
   }
  }

