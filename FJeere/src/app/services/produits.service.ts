import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class ProduitsService {

  constructor(private http:HttpClient) {}
  getAllProduits(): Observable<any[]>  {
  return this.http.get<any[]>(`${environment.apiUrl}/list` );
   
  }

}
