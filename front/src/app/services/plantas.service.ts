import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

import * as urls from "./urls"
const options:any = { headers: { 'Content-Type': 'application/json' } };

@Injectable({
  providedIn: 'root'
})
export class PlantasService {

  constructor(
    private http:HttpClient,
  ) { }

  get_plantas_list(query:string=''):Observable<any>{
    return this.http.get<any>(urls.plantas_list + '?' + query, options);
  }
}
