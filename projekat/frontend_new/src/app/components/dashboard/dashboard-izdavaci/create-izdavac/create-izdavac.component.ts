import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { IzdavacFactory } from 'src/app/factories/izdavac.factory';
import { Izdavac } from 'src/app/models/izdavac.model';
import { IzdavacService } from 'src/app/services/izdavac.service';

@Component({
  selector: 'app-create-izdavac',
  templateUrl: './create-izdavac.component.html',
  styleUrls: ['./create-izdavac.component.scss']
})
export class CreateIzdavacComponent implements OnInit {
  izdavac!: Izdavac;

  constructor(private izdavacService: IzdavacService, private snackBar: MatSnackBar, private dialogRef: MatDialogRef<CreateIzdavacComponent>) { }

  ngOnInit(): void {
    const izdavacFactory = new IzdavacFactory();
    this.izdavac = izdavacFactory.createDefault();
  }

  create() {
    this.izdavacService.kreirajIzdavaca(this.izdavac).subscribe({
      next: (response) => {
        console.log(response);
        this.snackBar.open(response.status, 'Zatvori', {
          duration: 3000,
          horizontalPosition: 'center',
          verticalPosition: 'bottom',
        });
        this.dialogRef.close(true);
      },
      error: console.log,
    })
  }
}
