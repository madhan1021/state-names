import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup,Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { ServerService } from '../server.service';


@Component({
  selector: 'app-dialog',
  templateUrl: './dialog.component.html',
  styleUrls: ['./dialog.component.scss']
})
export class DialogComponent implements OnInit {
  fg: FormGroup;
  result: any;

  constructor(
    private dialog: MatDialogRef<DialogComponent>,
    private dataservice: ServerService,
    public fb: FormBuilder,
    @Inject(MAT_DIALOG_DATA) public data: any
  ) { }

  ngOnInit() {

    // console.log(this.data);
    if (this.data.action == 'add') {
      this.forminitial();
    }
    if (this.data.action == 'edit') {
      this.formexist(this.data.data);
    }

  }

  forminitial() {
    this.fg = this.fb.group({
      StateName: new FormControl('',Validators.required),
      StateCode: new FormControl('',Validators.required)
    })
  }

  formexist(d) {
    this.fg = this.fb.group({
      StateName: [d.statename,],
      StateCode: [d.statecode,]
    })
  }

  onCancel() {
    this.dialog.close();
  }
  onDone() {
    this.dataservice.stname(this.fg.value).subscribe(r => {
      this.result = r;
      if (this.result.message == "successfully Done") {
        this.dialog.close(this.result.message);
      }
    });
  }
}
