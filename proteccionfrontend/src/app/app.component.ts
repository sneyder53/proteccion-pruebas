import { Component } from '@angular/core';
import { ImagenService } from './services/imagen.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [ImagenService]
})
export class AppComponent {
  title = 'Redimencion de Imagenes a tipo A4 para Imprimir';
  orientacion = 'Vertical';
  ancho = '555';
  alto = '999';
  public imagen = "";
  public filesToUpload: Array<File>;
  public resultUpload;

  constructor(private _imagenService : ImagenService,) { }


  crearImagen(){
    console.log(this.filesToUpload)
    this._imagenService.makefilerequest(this.filesToUpload).then(
      (result) => {
        this.resultUpload = result;
      //console.log(this.resultUpload);
        this.imagen = this.resultUpload['nombre'];
        this.orientacion = this.resultUpload['tipo'];
        this.ancho = this.resultUpload['ancho'];
        this.alto = this.resultUpload['alto'];
        console.log(this.imagen);
      },
      (error) => {
        console.log(error);
      }
      );
      //setTimeout("localtion.href='/imagen/tarjeta'", 4000);
    //window.location.href = "/imagen/tarjeta";
  }

  fileChangeEvent(fileInput: any){
    this.filesToUpload = <Array<File>>fileInput.target.files;
    console.log(this.filesToUpload);
  }

}
