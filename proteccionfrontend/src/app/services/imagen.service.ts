import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import { Observable } from 'rxjs/Observable';


@Injectable()

export class ImagenService{

	public url = "http://192.168.0.24:8080/upload";


	constructor(
		private _http: HttpClient){}


	makefilerequest( files: Array<File> ){
		return new Promise((resolve, reject) =>{
			var formData:any = new FormData();
			var xhr = new XMLHttpRequest();
			for (var i = 0 ; i < files.length; i++) {
				formData.append("image",files[i],files[i].name);
			}
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						resolve(JSON.parse(xhr.response));
					}else{
						reject(xhr.response);
					}
				}
			}
			xhr.open("POST",this.url, true);
			xhr.send(formData);



		});
  }
}
