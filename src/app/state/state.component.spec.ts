import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { stateComponent } from './state.component';

describe('DialogstateComponent', () => {
  let component: stateComponent;
  let fixture: ComponentFixture<stateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ stateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(stateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
