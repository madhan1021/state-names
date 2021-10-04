import { Component, OnInit } from '@angular/core';
import { DialogComponent } from '../state-name/dialog.component';
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { ServerService } from '../server.service';

// export interface Statenames {
//   SNo: number;
//   StateName: string;
//   StateCode: string;
//   action: string;


// }

// const STATE_DATA: Statenames[] = [
//   { SNo: 1, StateName: 'jhansi', StateCode: 'jh', action: '' },
//   { SNo: 2, StateName: 'Andhra pradesh', StateCode: 'ap', action: '' },
//   { SNo: 3, StateName: 'dcfd', StateCode: 'cdd', action: 'dv' },
//   { SNo: 4, StateName: 'cdd', StateCode: 'cdc', action: 'cdc', },
//   { SNo: 5, StateName: 'dcd', StateCode: 'cdd', action: 'cd', },
//   { SNo: 6, StateName: 'cdc', StateCode: 'cd', action: 'dcd', }
// ]


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
    dialogRef.width = " 20%";
    dialogRef.data={
      action :'add'
    }
    let dialog = this.dialog.open(DialogComponent, dialogRef);
    dialog.afterClosed().subscribe(res => {
      this.result = res;
      // console.log(this.result);      
      if (this.result == "sucessfully Done") {
        this.table();
      }
    })
  }

  editdialog(d) {
    let dialogRef = new MatDialogConfig();
    dialogRef.width = " 20%";
    dialogRef.data = {
      data : d,
      action: 'edit'
      
    }
    let dialog = this.dialog.open(DialogComponent, dialogRef);
    dialog.afterClosed().subscribe(res => {
      this.result = res;
      // console.log(this.result);      
      if (this.result == "sucessfully Done") {
        this.table();
      }
    })
    
  }

  table() {
    this.data.table(this.result).subscribe(re => {
      this.dataSource = re;
      console.log(this.dataSource);

    })
  }

  onRemove(d){
    // console.log(d);
    this.data.onRemove(d).subscribe(re=>{
      this.result = re;
      if(this.result.message == "sucessfully Done") {
        this.table();
      }
    });
  }

}










