import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { Client } from '../models/client';

@Injectable({
  providedIn: 'root'
})
export class ClientService {

  constructor( private http:HttpClient) { }

CreateCompteClient(data:any){
  return this.http.post<Client[]>(`${environment.apiUrl}/new/clients/`,data);
 
}


}
