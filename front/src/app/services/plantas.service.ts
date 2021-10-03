import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from "@angular/common/http";
import { Observable } from "rxjs";

import * as urls from "./urls"
const options:any = { headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' } };

@Injectable({
  providedIn: 'root'
})
export class PlantasService {

  constructor(
    private http:HttpClient,
  ) { }

  get_plantas_list(query:any={}):Observable<any>{
    return this.http.get<any>(urls.plantas_list, {...options , params: query });
  }

  search_plantas(query = {}):Observable<any>{
    return this.http.post<any>(urls.plantas_search, query, options);
  }

  get_tipos_list(query:string=''):Observable<any>{
    return this.http.get<any>(`${urls.tipos_list}?${query}`, options);
  }

  get_meses_list(query:string=''):Observable<any>{
    return this.http.get<any>(`${urls.meses_list}?${query}`, options);
  }

  get_maseta_data(query:string=''):Observable<any>{
    return this.http.get<any>(`${urls.macetas_data}?${query}`, options);
  }

  get_ficha(pk:number):Observable<any>{
    return this.http.get<any>(`${urls.ficha}${pk}`, options);
  }

  get_fuentes_list():Observable<any>{
    return this.http.get<any>(urls.fuentes_list, options);
  }

}
