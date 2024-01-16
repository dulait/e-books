import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { KnjigaService } from 'src/app/services/knjiga.service';

@Component({
  selector: 'app-home-knjige',
  templateUrl: './home-knjige.component.html',
  styleUrls: ['./home-knjige.component.scss']
})
export class HomeKnjigeComponent implements OnInit {

  knjige: any;
  izabranaKategorija: string = "Sve";
  jedinstveneKategorije: string[] = [];
  pageSlice: any

  constructor(private knjigaService: KnjigaService) { }

  @ViewChild(MatPaginator) paginator!: MatPaginator;

  ngOnInit(): void {
    this.vratiKnjigePoKategoriji(this.izabranaKategorija);
    console.log(this.pageSlice)
  }

  vratiSveKnjige() {
    this.knjigaService.vratiSveKnjige().subscribe({
      next: (response) => {
        this.knjige = response.knjige;
        console.log(response);
        this.vratiJedinstveneKategorije();
        this.pageSlice = this.knjige.slice(0, 4);
      },
      error: console.log,
    })
  }

  vratiJedinstveneKategorije() {
    const kategorije: string[] = this.knjige?.map((knjiga: any) => knjiga.kategorija);
    if (kategorije) {
      this.jedinstveneKategorije = [...new Set(kategorije)];
    }
  }

  vratiKnjigePoKategoriji(kategorija: string): any {
    if (kategorija === "Sve" || !kategorija) {
      this.vratiSveKnjige();
    } else {
      this.knjigaService.vratiKnjigePoKategoriji(kategorija).subscribe({
        next: (response) => {
          this.knjige = response.knjige;
          this.pageSlice = this.knjige.slice(0, 4);
        },
        error: console.log
      })
    }
  }

  onKategorijaChange(izabranaKategorija: string): void {
    this.izabranaKategorija = izabranaKategorija;
    this.vratiKnjigePoKategoriji(this.izabranaKategorija);
    this.pageSlice = this.knjige.slice(0, 4);
  }

  onPageChange(event: PageEvent) {
    console.log(event);
    const startIndex = event.pageIndex * event.pageSize;
    let endIndex = startIndex + event.pageSize;
    if (endIndex > this.knjige.length) {
      endIndex = this.knjige.length;
    }
    this.pageSlice = this.knjige.slice(startIndex, endIndex);
  }

}