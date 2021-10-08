import { Component, OnInit } from '@angular/core';
import { DialogComponent } from '../dialog/dialog.component';
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { ServerService } from '../server.service';

@Component({
  selector: 'app-dialogstate',
  templateUrl: './state.component.html',
  styleUrls: ['./state.component.scss']
})
export class stateComponent implements OnInit {
  result: any;

  constructor(
    private dialog: MatDialog,
    private data: ServerService,
    private router: Router) { }
  displayedColumns: string[] = ['id', 'statename', 'statecode', 'action'];
  dataSource: any;

  ngOnInit() {
    this.table();
  }


  openDialog() {
    let dialogRef = new MatDialogConfig();
    dialogRef.width = "20%";
    dialogRef.data={
      action :'add'
    }
    let dialog1 = this.dialog.open(DialogComponent, dialogRef);
    dialog1.afterClosed().subscribe(res => {
      this.result = res;
      if (this.result == "successfully Done") {
        this.table();
      }
    })
  }

  editdialog(d) {
    let dialogRef = new MatDialogConfig();
    dialogRef.width = "20%";
    dialogRef.data = {
      data : d,
      action: 'edit'

    }
    let dialog2 = this.dialog.open(DialogComponent, dialogRef);
    dialog2.afterClosed().subscribe(res => {
      this.result = res;
      // console.log(this.result);
      if (this.result == "successfully Done") {
        this.table();
      }
    })

  }

  table() {
    this.data.table_data(this.result).subscribe(re => {
      this.dataSource = re;
    })
  }

  onRemove(d){
    // console.log(d);
    this.data.onRemove(d).subscribe(re=>{
      this.result = re;
      if(this.result.message == "successfully Done") {
        this.table();
      }
    });
  }

}










